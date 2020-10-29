<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Form\TrickFormType;
use App\Repository\PictureRepository;
use App\Repository\TrickRepository;
use App\Service\UploadHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class TrickController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(TrickRepository $trickRepository)
    {
        $tricks = $trickRepository->findAll();

        return $this->render(
            'trick/homepage.html.twig', [
            'tricks' => $tricks
            ]
        );
    }

    /**
     * @Route("/trick/new", name="app_trick_new")
     */
    public function new(EntityManagerInterface $em, Request $request, UploadHelper $uploadHelper)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $trickForm = $this->createForm(TrickFormType::class);

        $trickForm->handleRequest($request);

        if ($trickForm->isSubmitted() && $trickForm->isValid()) {
            /** @var Trick $trick */
            $trick = $trickForm->getData();
            $trick->setUser($this->getUser());

            $em->persist($trick);
            $em->flush();

            /** @var UploadedFile $picture */
            $pictureFile = $trickForm->get('path')->getData();

            if ($pictureFile) {
                $picture = new Picture();
                $newFilename = $uploadHelper->uploadTrickMainPicture($pictureFile);

                $picture->setPath($newFilename);
                $picture->setIsMain(true);
                $picture->setLegend($trickForm->get('legend')->getData());
                $picture->setTrick($trick);

                $em->persist($picture);
                $em->flush();

            }

            $this->addFlash('success', "Le trick à bien été créé");

            return $this->redirectToRoute('app_trick_show', ['slug' => $trick->getSlug()]);
        }

        return $this->render(
            'trick/create.html.twig', [
                'trickForm' => $trickForm->createView()
            ]
        );
    }

    /**
     * @Route("/trick/{slug}/modify", name="app_trick_modify")
     */
    public function modify(EntityManagerInterface $em, Request $request, Trick $trick, PictureRepository $pictureRepository)
    {
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->remove('path');
        $form->remove('legend');

        $mainPicture = $pictureRepository->findMainPictureByTrick($trick);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Trick $trick */
            $trick = $form->getData();

            $em->persist($trick);
            $em->flush();

            return $this->redirectToRoute('app_trick_show', ['id' => $trick->getId()]);
        }

        return $this->render(
            'trick/modify.html.twig', [
                'trickForm' => $form->createView(),
                'trick' => $trick,
                'mainPicture' => $mainPicture
            ]
        );
    }

    /**
     * @Route("/trick/{id}/delete", name="app_trick_delete")
     */
    public function delete(EntityManagerInterface $em, Trick $trick)
    {
            $trick->setIsDeleted(true);

            $em->persist($trick);
            $em->flush();

            return $this->redirectToRoute('app_homepage');
    }

    /**
     * @Route("/trick/{slug}", name="app_trick_show", methods={"GET", "POST"}, options={"expose"=true})
     */
    public function show(EntityManagerInterface $em, Request $request, Trick $trick, PictureRepository $pictureRepository)
    {
        $form = $this->createForm(CommentFormType::class );

        $form->handleRequest($request);

        $mainPicture = $pictureRepository->findMainPictureByTrick($trick);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->isXmlHttpRequest()) {
                /** @var Comment $comment */
                $comment = $form->getData();
                $comment->setUser($this->getUser());
                $comment->setTrick($trick);

                $em->persist($comment);
                $em->flush();

                return $this->json($comment, 200, [], [
                    ObjectNormalizer::ATTRIBUTES => ['user' => ['username', 'picturePath'], 'content', 'createdAt']
                ]);
            }
            return $this->json([
                'type' => 'error',
                'message' => 'Ajax required'
            ]);
        }
        return $this->render(
            'trick/show.html.twig', [
                'trick' => $trick,
                'commentForm' => $form->createView()
            ]
        );
    }

}