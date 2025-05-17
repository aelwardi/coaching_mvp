<?php

namespace App\Controller\Admin;

use App\Entity\Coach;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\Persistence\ObjectManager;

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
        $fields = [
            TextField::new('fullName')->setLabel('Nom et prénom'),
            TextField::new('speciality'),
            TextareaField::new('description'),
            SlugField::new('slug')->setLabel('URL')->setTargetFieldName('fullName')->setHelp("URL de votre coach générée automatiquement"),
        ];
        if (in_array($pageName, [Crud::PAGE_DETAIL, Crud::PAGE_INDEX])) {
            $fields[] = AssociationField::new('usere', 'Admin associé');
        }
        return $fields;
    }
    public function persistEntity(ObjectManager $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Coach) {
            $entityInstance->setUsere($this->getUser());
        }
        parent::persistEntity($entityManager, $entityInstance);
    }
}
