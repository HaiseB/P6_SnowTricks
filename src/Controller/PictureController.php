<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Trick;
use App\Form\PictureFormType;
use App\Repository\PictureRepository;
use App\Service\UploadHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class PictureController extends AbstractController
{
    /**
     * @Route("/picturesByTrick/{trick}", name="app_pictures_show", methods="GET", options={"expose"=true})
     */
    public function trickPictures(Request $request, Trick $trick, PictureRepository $pictureRepository) {
        if ($request->isXmlHttpRequest()) {
            $pictures = $pictureRepository->findPicturesByTrickExceptMain($trick);

            return $this->json($pictures, 200, [], [
                ObjectNormalizer::ATTRIBUTES => ['id', 'path', 'legend', 'createdAt']
            ]);
        }

        return $this->json([
            'type' => 'error',
            'message' => 'Ajax required'
        ]);
    }

    /**
     * @Route("trick/{id}/addMainPicture", name="app_trick_add_main_picture")
     */
    public function newMain(EntityManagerInterface $em, Request $request, PictureRepository $pictureRepository, Trick $trick, UploadHelper $uploadHelper)
    {
        $pictureForm = $this->createForm(PictureFormType::class );

        $mainPicture = $pictureRepository->findMainPictureByTrick($trick);

        $pictureForm->handleRequest($request);

        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            if (count($mainPicture) > 0) {
                $pictureRepository->delete($mainPicture[0], $em);
            }

            /** @var UploadedFile $picture */
            $picture = $pictureForm->getData();

            $pictureFile = $pictureForm->get('path')->getData();

            $newFilename = $uploadHelper->uploadTrickMainPicture($pictureFile);

            $picture->setPath($newFilename);
            $picture->setIsMain(true);
            $picture->setTrick($trick);

            $em->persist($picture);
            $em->flush();

            return $this->redirectToRoute('app_trick_modify', ['id' => $trick->getId()]);
        }

        return $this->render(
            'picture/createMain.html.twig', [
                'pictureForm' => $pictureForm->createView(),
                'mainPicture' => $mainPicture,
                'trick' => $trick
            ]
        );
    }

    /**
     * @Route("trick/{id}/addLinkedPicture", name="app_trick_add_linked_picture")
     */
    public function newLinked(EntityManagerInterface $em, Request $request, Trick $trick, UploadHelper $uploadHelper)
    {
        $pictureForm = $this->createForm(PictureFormType::class );

        $pictureForm->handleRequest($request);

        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            /** @var UploadedFile $picture */
            $picture = $pictureForm->getData();

            $pictureFile = $pictureForm->get('path')->getData();

            $newFilename = $uploadHelper->uploadTrickLinkedPicture($pictureFile);

            $picture->setPath($newFilename);
            $picture->setIsMain(false);
            $picture->setTrick($trick);

            $em->persist($picture);
            $em->flush();

            return $this->redirectToRoute('app_trick_modify', ['id' => $trick->getId()]);
        }

        return $this->render(
            'picture/createLinked.html.twig', [
                'pictureForm' => $pictureForm->createView(),
                'trick' => $trick
            ]
        );
    }

    /**
     * @Route("trick/{id}/deleteMainPicture", name="app_trick_delete_main_picture")
     */
    public function deleteMain(EntityManagerInterface $em, PictureRepository $pictureRepository, Trick $trick)
    {
        $mainPicture = $pictureRepository->findMainPictureByTrick($trick);

        $pictureRepository->delete($mainPicture[0], $em);

        return $this->redirectToRoute('app_trick_modify', ['id' => $trick->getId()]);
    }

    /**
     * @Route("deleteLinkedPicture/{id}", name="app_trick_delete_linked_picture", methods="GET", options={"expose"=true})
     */
    public function deleteLink(Request $request, EntityManagerInterface $em, PictureRepository $pictureRepository, Picture $picture)
    {
        $pictureRepository->delete($picture, $em);

        return $this->redirectToRoute('app_trick_modify', ['id' => $picture->getTrick()->getId()]);
    }
}