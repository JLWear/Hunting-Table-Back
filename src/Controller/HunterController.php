<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HunterController extends AbstractController
{
    #[Route('/hunter', name: 'app_hunter')]
    public function index(): Response
    {
        return $this->render('hunter/index.html.twig', [
            'controller_name' => 'HunterController',
        ]);
    }
}
