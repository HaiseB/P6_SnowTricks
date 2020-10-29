<?php


namespace App\Controller;


use App\Entity\Trick;
use App\Entity\Video;
use App\Form\VideoFormType;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

class VideoController extends AbstractController
{
    /**
     * @Route("/videoByTrick/{trick}", name="app_videos_show", methods="GET", options={"expose"=true})
     */
    public function trickPictures(Request $request, Trick $trick, VideoRepository $videoRepository) {
        if ($request->isXmlHttpRequest()) {
            $videos = $videoRepository->findVideosByTrick($trick);

            return $this->json($videos, 200, [], [
                AbstractObjectNormalizer::ATTRIBUTES => ['id', 'url', 'createdAt']
            ]);
        }

        return $this->json([
            'type' => 'error',
            'message' => 'Ajax required'
        ]);
    }

    /**
     * @Route("trick/{id}/addLinkedVideo", name="app_trick_add_linked_video")
     */
    public function new(EntityManagerInterface $em, Request $request, Trick $trick)
    {
        $videoForm = $this->createForm(VideoFormType::class);

        $videoForm->handleRequest($request);

        if ($videoForm->isSubmitted() && $videoForm->isValid()) {
            /** @var Video $video */
            $video = $videoForm->getData();
            $video->setTrick($trick);

            $em->persist($video);
            $em->flush();

            return $this->redirectToRoute('app_trick_modify', ['id' => $trick->getId()]);
        }

        return $this->render(
            'video/create.html.twig', [
                'pictureForm' => $videoForm->createView(),
                'trick' => $trick
            ]
        );
    }

    /**
     * @Route("deleteLinkedVideo/{id}", name="app_trick_delete_linked_video", methods="GET", options={"expose"=true})
     */
    public function deleteLink(EntityManagerInterface $em,  Video $video)
    {
        $video->setIsDeleted(true);

        $em->persist($video);
        $em->flush();

        return $this->redirectToRoute('app_trick_modify', ['id' => $video->getTrick()->getId()]);
    }
}