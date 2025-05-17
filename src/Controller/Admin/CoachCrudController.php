<?php

namespace App\Controller\Admin;

use App\Entity\Coach;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class CoachCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coach::class;
    }

     public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Coach')
            ->setEntityLabelInPlural('Coaches')
            ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('fullName')->setLabel('Nom et prénom'),
            TextField::new('speciality'),
            TextEditorField::new('description'),
            SlugField::new('slug')->setLabel('URL')->setTargetFieldName('fullName')->setHelp("URL de votre coach générée automatiquement"),
        ];
    }
}
