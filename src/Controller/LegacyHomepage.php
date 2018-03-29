<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/")
 */
class LegacyHomepage{

    private $twing;


    public function __construct(Environment $twing){
        $this->twing = $twing;
    }

    public function __invoke(): Response
    {
        return new Response($this->twing->render('homepage.html.twing'));
    }
}
