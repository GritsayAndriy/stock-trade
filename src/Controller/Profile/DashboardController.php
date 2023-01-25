<?php

declare(strict_types=1);

namespace App\Controller\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        $wallets  = $this->getUser()->getWallets();
        return $this->render('/dashboard/index.html.twig', [
            'wallets' => $wallets,
        ]);
    }
}
