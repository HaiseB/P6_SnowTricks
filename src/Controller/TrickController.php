<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\User;
use App\Entity\Tag;
use App\Form\TrickFormType;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
        $form = $this->createForm(TrickFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Trick $trick */
            $trick = $form->getData();

            $timestamp = new \DateTime();
            $trick->setCreatedAt($timestamp);
            $trick->setUpdatedAt($timestamp);

            $user = $em->getRepository(User::class)->find(41);
            $trick->setUser($user);

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
    public function modify(EntityManagerInterface $em, Request $request, Trick $trick, $id)
    {
        //@TODO : modify function
    }

    /**
     * @Route("/trick/{id}/delete", name="app_trick_delete")
     */
    public function delete(EntityManagerInterface $em, Trick $trick, $id)
    {
            $trick->setIsDeleted(true);

            $em->persist($trick);
            $em->flush();

            return $this->redirectToRoute('app_homepage');
    }

    /**
     * @Route("/trick/{id}", name="app_trick_show")
     */
    public function show(Trick $trick, $id)
    {
        return $this->render(
            'trick/show.html.twig', [
                'trick' => $trick
            ]
        );
    }


}