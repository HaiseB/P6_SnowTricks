<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CommentController extends AbstractController
{
    /**
     * @Route("/commentsByTrick/{trick}/{offset}", name="app_comment_show", methods="GET", options={"expose"=true})
     */
    public function trickComments(Request $request, Trick $trick, Int $offset, CommentRepository $commentRepository) {
        if ($request->isXmlHttpRequest()) {
            $comments = $commentRepository->findCommentsByTrickAndOffset($trick, $offset);

            return $this->json($comments, 200, [], [
                ObjectNormalizer::ATTRIBUTES => ['user' => ['username', 'picturePath'], 'content', 'createdAt']
            ]);
        }

        return $this->json([
            'type' => 'error',
            'message' => 'Ajax required'
        ]);
    }

}