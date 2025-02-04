<?php

namespace App\Controller\Admin;

use App\Entity\Artical;
use App\Entity\ArticleType;
use App\Entity\Blog;
use App\Entity\Images;
use App\Entity\Realisations;
use App\Entity\Projet;
use App\Entity\ArticleDescription;
use App\Entity\RealisationType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('bundles/EasyAdminBundle/views/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/front/img/logo.png" width="30%"/>')
            ->setFaviconPath('/front/img/logo.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('Blog', 'fa-solid fa-blog', Blog::class);
       
        yield MenuItem::subMenu('Article', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Article', 'fa fa-bars', Artical::class),
            MenuItem::linkToCrud("Type d'article", 'fa fa-bars', ArticleType::class),
            MenuItem::linkToCrud( "Description d'article", 'fa-solid fa-pencil', ArticleDescription::class),
        ]);
        // ...
    
        // yield MenuItem::linkToCrud('Artical', 'fa fa-bars', Artical::class); 
        // yield MenuItem::linkToCrud('Artical Type', 'fa fa-bars', ArticleType::class); 
        // yield MenuItem::linkToCrud('Artical Description', 'fa-solid fa-pencil', ArticleDescription::class); 
        // yield MenuItem::linkToCrud('Projet', 'fa-solid fa-building', Projet::class); 
       
        
        yield MenuItem::subMenu('Realisations', 'fa-solid fa-city')->setSubItems([
            MenuItem::linkToCrud('Realisation', 'fa-solid fa-city', Realisations::class),
            MenuItem::linkToCrud("Realisation type", 'fa fa-tags', RealisationType::class),
            MenuItem::linkToCrud('Realisation images', 'fa-solid fa-image', Images::class)
           
        ]);
    
        
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
