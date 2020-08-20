<?php

namespace App\Controller;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render(
            'trick/homepage.html.twig'
        );
    }

    /**
     * @Route("/trick/new", name="app_trick_create")
     */
    public function create()
    {
        $trick = new Trick();

        $form = $this->createFormBuilder($trick)
            ->add('name')
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('is_online', ChoiceType::class, [
                'choices' => [
                    'In Stock' => true,
                    'Out of Stock' => false,
                ],
            ])
            ->getForm();

        return $this->render('trick/create.html.twig', [
            'formTrick' => $form->createView()
        ]);
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