<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalletController extends AbstractController
{
    #[Route('/wallets', name: 'app_wallets')]
    public function index(): Response
    {
        return $this->render('wallets/index.html.twig', [
            'controller_name' => 'WalletsController',
        ]);
    }
}
