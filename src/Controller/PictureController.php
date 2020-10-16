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
     * @Route("/mainPictureOfTrick/{trick}", name="app_main_picture_show", methods="GET", options={"expose"=true})
     */
    public function trickMainPicture(Request $request, Trick $trick, PictureRepository $pictureRepository) {
        if ($request->isXmlHttpRequest()) {
            $picture = $pictureRepository->findMainPictureByTrick($trick);

            return $this->json($picture, 200, [], [
                ObjectNormalizer::ATTRIBUTES => ['path', 'legend', 'createdAt']
            ]);
        }

        return $this->json([
            'type' => 'error',
            'message' => 'Ajax required'
        ]);
    }

    /**
     * @Route("/picturesByTrick/{trick}", name="app_pictures_show", methods="GET", options={"expose"=true})
     */
    public function trickPictures(Request $request, Trick $trick, PictureRepository $pictureRepository) {
        if ($request->isXmlHttpRequest()) {
            $pictures = $pictureRepository->findPicturesByTrickExceptMain($trick);

            return $this->json($pictures, 200, [], [
                ObjectNormalizer::ATTRIBUTES => ['path', 'legend', 'createdAt']
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
    public function new(EntityManagerInterface $em, Request $request, PictureRepository $pictureRepository, Trick $trick, UploadHelper $uploadHelper)
    {
        $pictureForm = $this->createForm(PictureFormType::class );

        $mainPicture = $pictureRepository->findMainPictureByTrick($trick);

        $pictureForm->handleRequest($request);

        if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
            if (count($mainPicture) > 0) {
                $mainPicture[0]->setIsDeleted(true);
                $em->persist($mainPicture[0]);
                $em->flush();
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
     * @Route("trick/{id}/deleteMainPicture", name="app_trick_delete_main_picture")
     */
    public function delete(EntityManagerInterface $em, Request $request, PictureRepository $pictureRepository, Trick $trick, UploadHelper $uploadHelper)
    {
        $mainPicture = $pictureRepository->findMainPictureByTrick($trick);
        $mainPicture[0]->setIsDeleted(true);
        $em->persist($mainPicture[0]);
        $em->flush();

        return $this->redirectToRoute('app_trick_modify', ['id' => $trick->getId()]);
    }

}