<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Form\TrickFormType;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function new(EntityManagerInterface $em, Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(TrickFormType::class );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Trick $trick */
            $trick = $form->getData();
            $trick->setUser($this->getUser());

            $em->persist($trick);
            $em->flush();

            return $this->redirectToRoute('app_trick_show', ['id' => $trick->getId()]);
        }

        return $this->render(
            'trick/create.html.twig', [
                'trickForm' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/trick/{id}/modify", name="app_trick_modify")
     */
    public function modify(EntityManagerInterface $em, Request $request, Trick $trick)
    {
        $form = $this->createForm(TrickFormType::class, $trick );

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
                'trick' => $trick
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
     * @Route("/trick/{id}", name="app_trick_show", methods={"GET", "POST"}, options={"expose"=true})
     */
    public function show(EntityManagerInterface $em, Request $request, Trick $trick)
    {
        $form = $this->createForm(CommentFormType::class );

        $form->handleRequest($request);

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