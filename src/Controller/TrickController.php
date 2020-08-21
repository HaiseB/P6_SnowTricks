<?php

namespace App\Controller;

use App\Entity\Trick;
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

            dd($trick);

            $em->persist($trick);
            $em->flush();

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render(
            'trick/create.html.twig', [
            'trickForm' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/trick/{id}/{slug}", name="app_trick_show")
     */
    public function show(Trick $trick, $id, $slug)
    {
        $name = ucwords(str_replace('-', ' ', $slug));

        $trick = $name;

        return $this->render(
            'trick/show.html.twig', [
                'trick' => $trick
            ]
        );
    }


}