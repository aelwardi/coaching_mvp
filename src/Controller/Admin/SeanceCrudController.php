<?php

namespace App\Controller\Admin;

use App\Entity\Seance;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Enum\statusSeanceEnum;

class SeanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Seance::class;
    }

            public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Séance')
            ->setEntityLabelInPlural('Séances')
            ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('status')
                ->setLabel('Statut')
                ->setChoices([
                    'pending' => statusSeanceEnum::PENDING,
                    'in progress' => statusSeanceEnum::IN_PROGRESS,
                    'completed' => statusSeanceEnum::COMPLETED,
                ])
                ->setHelp('Statut de la séance.'),
            DateField::new('date')
                ->setLabel('Date de la séance')
                ->setHelp('Date de la séance.'),
            TimeField::new('startAt')
                ->setLabel('Heure de début')
                ->setHelp('Heure de début de la séance.'),
            TimeField::new('endAt')
                ->setLabel('Heure de fin')
                ->setHelp('Heure de fin de la séance.'),
            AssociationField::new('programme', 'Programme associé'),
        ];
    }
}
