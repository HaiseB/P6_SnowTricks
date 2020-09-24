<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/commentsByTrick/{trick}", name="app_comment_show", methods="POST")
     */
    public function trickComments(Trick $trick, CommentRepository $commentRepository) {
        $comments = $commentRepository->findBy(
            ['trick' => $trick]
        );

        dd($comments);

        return $this->json([$comments]);
    }

    /**
     * @Route("/comment/new/{trick}", name="app_comment_new")
     */
    public function new(EntityManagerInterface $em, Request $request, Trick $trick)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(CommentFormType::class );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Comment $comment */
            $comment = $form->getData();
            $comment->setUser($this->getUser());
            $comment->setTrick($trick);

            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('app_trick_show', ['id' => $trick->getId()]);
        }

        return $this->render(
            'comment/create.html.twig', [
                'commentForm' => $form->createView()
            ]
        );
    }
}