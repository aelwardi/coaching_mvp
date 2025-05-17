<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Member')
            ->setEntityLabelInPlural('Members')
            ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            // Afficher l'email en lecture seule dans l'édition, et sur l'index
            TextField::new('email')->setLabel('Email')
                ->onlyOnIndex(),
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('password')
                ->setFormTypeOption('disabled', true)
                ->setFormTypeOption('help', 'Password is hashed and cannot be changed here'),
        ];
        
        if ($pageName === Crud::PAGE_EDIT) {
            array_unshift($fields, TextField::new('email')->setLabel('Email')->setFormTypeOption('disabled', true));
        }
        
        if ($pageName === Crud::PAGE_INDEX) {
            $fields[] = ChoiceField::new('roles', 'Rôles')
                ->setChoices([
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Banni' => 'BANNED',
                ])
                ->allowMultipleChoices(true)
                ->renderAsBadges();
        }
        if (in_array($pageName, [Crud::PAGE_NEW, Crud::PAGE_EDIT])) {
            $fields[] = ChoiceField::new('roles', 'Rôles')
                ->setChoices([
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Banni' => 'BANNED',
                ])
                ->allowMultipleChoices(true)
                ->renderExpanded(true)
                ->setFormTypeOption('by_reference', false)
                ->setFormTypeOption('empty_data', []);
        }
        return $fields;
    }
    
}
