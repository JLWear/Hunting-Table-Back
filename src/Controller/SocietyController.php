<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocietyController extends AbstractController
{
    #[Route('/society', name: 'app_society')]
    public function index(): Response
    {
        return $this->render('society/index.html.twig', [
            'controller_name' => 'SocietyController',
        ]);
    }
}
