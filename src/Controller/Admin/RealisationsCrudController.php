<?php

namespace App\Controller\Admin;

use App\Entity\Realisations;
use App\Entity\RealisationType;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class RealisationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Realisations::class;
    }
   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('title', 'Titre'),
            TextEditorField::new('description'),
            TextEditorField::new('descriptionPrincipal', 'description principale'),
            TextField::new('city', 'ville'),
            AssociationField::new('realisationTypes'),
            TextField::new('superficie'),
            ImageField::new('image')->setBasePath('front/img/')->setUploadDir('public/front/img')->setRequired(false),
            
        ];
    }
   
//   public function configureFields(string $pageName): iterable
//     {
//         return [
//             IdField::new('id')->onlyOnDetail(),
//             TextField::new('title'),
//              AssociationField::new('artical'),
//         ];
//     }
    
   public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter realisation');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('Modifier realisation');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('Supprimer realisation');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Enregistrer les modifications');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setLabel('Enregistrer et continuer l’édition');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Créer');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action->setLabel('Créer et ajouter un autre');
            });
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ->setPageTitle('index', 'Créer Article')
            ->setPageTitle('edit', "Modifier realisation")
            ->setPageTitle('new', "Créer realisation")
          ;
    }
}
