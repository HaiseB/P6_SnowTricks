<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TricksController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Homepager');
    }

    /**
     * @Route("/tricks/{slug}")
     */
    public function show($slug)
    {
        return $this->render('tricks/show.html.twig', [
            'trick' => ucwords(str_replace('-', ' ', $slug))
        ]);
    }

}