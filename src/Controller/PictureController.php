<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

}