<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\PictureFormType;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\String\Slugger\SluggerInterface;

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
     * @Route("/{id}/test", name="app_trick_test")
     */
    public function new(EntityManagerInterface $em, Request $request, SluggerInterface $slugger, Trick $trick)
    {
        $pictureForm = $this->createForm(PictureFormType::class );

        $pictureForm->handleRequest($request);

            if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
                /** @var UploadedFile $picture */
                $picture = $pictureForm->getData();

                $this->getParameter('main_picture_directory');

                $pictureFile = $pictureForm->get('path')->getData();

                $destination = $this->getParameter('main_picture_directory');

                /*$originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

                $pictureFile->move(
                    $destination,
                    $newFilename
                );*/

                $picture->setPath($newFilename);
                $picture->setIsMain(true);
                $picture->setTrick($trick);

                $em->persist($picture);
                $em->flush();
            }


        return $this->render(
            'picture/create.html.twig', [
                'pictureForm' => $pictureForm->createView()
            ]
        );
    }

}