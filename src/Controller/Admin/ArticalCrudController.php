<?php

namespace App\Controller\Admin;

use App\Entity\Artical;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class ArticalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artical::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           IdField::new('id')->onlyOnDetail(),
            ImageField::new('image')->setBasePath('front/img/')->setUploadDir('public/front/img'),
            TextField::new('title','Titre'),
            TextField::new('slug','Slug'),
            // TextField::new('text'),
            TextEditorField::new('description'),
            TextEditorField::new('conclusion'),
        ];
    }
    
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel("Ajouter Article");
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action
                    ->setLabel('Modifier') ;// Change the label if needed
                    //   ->setIcon('fa fa-edit'); // Add to dropdown
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action
                    ->setLabel('Supprimer') ;// Change the label if needed
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
            ->setPageTitle('edit', 'Modifier Article')
            ->setPageTitle('new', 'Créer Article')
          ;
    }
}
