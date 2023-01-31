<?php

namespace App\Controller\Admin;

use App\Entity\CurrencyPair;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CurrencyPairCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CurrencyPair::class;
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
