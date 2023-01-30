<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\WalletRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile')]
class WalletController extends AbstractController
{
    #[Route('/wallets', name: 'app_wallet')]
    public function index(): Response
    {
        $wallets = $this->getUser()->getWallets();
        return $this->render('wallet/index.html.twig', [
            'wallets' => $wallets
        ]);
    }
}
