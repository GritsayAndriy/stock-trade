<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Offer;
use App\Repository\CurrencyPairRepository;
use App\Repository\CurrencyRepository;
use App\Repository\OfferRepository;
use App\Services\DealService;
use App\Services\OfferService;
use App\Services\TransactionService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('profile')]
class OfferController extends AbstractController
{
    public function __construct(
        private OfferRepository $offerRepository,
        private CurrencyPairRepository $currencyPairRepository,
        private CurrencyRepository $currencyRepository,
        private TransactionService $transactionService,
        private ManagerRegistry $doctrine
    ) {
    }

    #[Route('/offer', methods: ['GET'], name: 'app_offer')]
    public function index(): Response
    {
        $user = $this->getUser();
        $userOffers = $this->offerRepository->findBy([
            'user' => $user->getId()],
            ['id' => 'DESC']
        );
        $otherOffers = $this->offerRepository->findByNotUser($user->getId());

        return $this->render('offer/index.html.twig', [
            'offers' => $userOffers,
            'otherOffers' => $otherOffers
        ]);
    }

    #[Route('/offer/create', name: 'app_create_offer')]
    public function create(): Response
    {
        $currencyPair = $this->currencyPairRepository->findAll();
        return $this->render('offer/create.html.twig', [
            'currencyPairs' => $currencyPair
        ]);
    }

    #[Route('/offer', methods: ['POST'], name: 'app_store_offer')]
    public function store(ValidatorInterface $validator, OfferService $offerService)
    {
        $offer = $offerService->createOffer()->getCreatedOffer();
        $reservedTransaction = $offerService->getReservedTransaction();
        $errorsOffer = $validator->validate($offer);
        $errorsTransaction = $validator->validate($reservedTransaction);

        if (count($errorsOffer) > 0 || count($errorsTransaction) > 0) {
            $errorsString = $errorsOffer . ' ' . $errorsTransaction;
            return new Response($errorsString);
        }
        $this->doctrine->getManager()->flush();
        return $this->redirectToRoute('app_offer');
    }

    #[Route('/offer/{id}/buy', name: 'app_buy_offer')]
    public function buy(int $id, DealService $dealService)
    {
        $offer = $this->offerRepository->find($id);
        $dealService->executeDeal();
        return $this->redirectToRoute('app_offer');
    }

    #[Route('/offer/{id}/cancel', name: 'app_cancel_offer')]
    public function cancel(int $id)
    {
        $offer = $this->offerRepository->findBy([
            'id' => $id,
            'user' => $this->getUser()->getId()
        ])[0];
        if (!$offer) {
            throw $this->createNotFoundException(
                'No offer found for id ' . $id
            );
        }
        $offer->setStatus(Offer::STATUS_CANCEL);
        $this->offerRepository->save($offer, true);
        return $this->redirectToRoute('app_offer');
    }
}
