<?php

namespace App\Controller\Admin;

use App\Entity\WalletTransaction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WalletTransactionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WalletTransaction::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
