<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KillController extends AbstractController
{
    #[Route('/kill', name: 'app_kill')]
    public function index(): Response
    {
        return $this->render('kill/index.html.twig', [
            'controller_name' => 'KillController',
        ]);
    }
}
