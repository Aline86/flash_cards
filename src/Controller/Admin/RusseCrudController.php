<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use App\Entity\Russe;
use App\Entity\Theme;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
class RusseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Russe::class;
    }


 public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('fr'),
            TextField::new('ru'),
            IntegerField::new('theme'),
        ];
    }
    
}
