<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Images::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            ImageField::new('upload')->setBasePath('front/img/')->setUploadDir('public/front/img'),
            TextField::new('titleImage', 'Titre image'),
            AssociationField::new('realisation'),



            // TextField::new('title'),
            // TextEditorField::new('description'),
        ];
    }
    
    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         IdField::new('id')->onlyOnDetail(),
    //         TextField::new('title'),
    //          AssociationField::new('artical'),
    //     ];
    // }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel("Ajouter image d'article");
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action
                    ->setLabel("Modifier image d'article") ;// Change the label if needed
                    //   ->setIcon('fa fa-edit'); // Add to dropdown
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action
                    ->setLabel("Supprimer image d'article") ;// Change the label if needed
                    //   ->setIcon('fa fa-edit'); // Add to dropdown
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                    return $action->setLabel('Enregistrer les modifications'); // Custom label for "Save and Return"
                })
                 ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                    return $action->setLabel('Enregistrer et continuer l’édition'); // Custom label for "Save and Return"
                })
                 ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Créer');
                 })
                  ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action->setLabel('Créer et ajouter un autre');
                 })
            ;
          
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ->setPageTitle('index', 'Créer Article')
            ->setPageTitle('edit', "Modifier image d'article")
            ->setPageTitle('new', "Créer image d'article")
          ;
    }
    
   
}
