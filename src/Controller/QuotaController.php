<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuotaController extends AbstractController
{
    #[Route('/quota', name: 'app_quota')]
    public function index(): Response
    {
        return $this->render('quota/index.html.twig', [
            'controller_name' => 'QuotaController',
        ]);
    }
}
