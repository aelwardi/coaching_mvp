<?php

namespace App\Controller\Admin;

use App\Entity\Programme;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ProgrammeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Programme::class;
    }

        public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Programme')
            ->setEntityLabelInPlural('Programmes')
            ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $required = true;
            if ($pageName == 'edit') {
                $required = false;
            }
            
        return [

            TextField::new('title'),
            TextareaField::new('description'),
            SlugField::new('slug')->setLabel('URL')->setTargetFieldName('title')->setHelp("URL de votre programme générée automatiquement"),
            ImageField::new('image')
                ->setLabel('Image')
                ->setHelp("Image du programme en 600x600px.")
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setUploadDir('public/uploads')
                ->setBasePath('/uploads')
                ->setRequired($required),
            AssociationField::new('coach', 'Coach associé')
        ];
    }

}
