<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return new Response('Homepager');
    }

    /**
     * @Route("/tricks/{slug}", name="app_trick_show")
     */
    public function show($slug)
    {
        $name = ucwords(str_replace('-', ' ', $slug));

        $trick = $name;

        return $this->render('tricks/show.html.twig', [
            'trick' => $trick
        ]);
    }

}