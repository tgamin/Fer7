<?php

namespace App\Controller;

use App\Entity\Artical;
use App\Entity\Projet;
use App\Entity\Realisations;
use App\Repository\ArticalRepository;
use App\Repository\BlogRepository;
use App\Repository\ProjetRepository;
use App\Repository\RealisationsRepository;
use App\Repository\RealisationTypeRepository;
use ContainerBYAe9Wr\getProjetRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;
class DefaultController extends AbstractController
{
   private $projetsRepository, $realisationTypeRepository, $articleRepository;

    public function __construct(ProjetRepository $projetRepository, RealisationTypeRepository $realisationTypeRepository, ArticalRepository $articleRepository)
    {
        $this->projetsRepository = $projetRepository;
        $this->realisationTypeRepository = $realisationTypeRepository;
        $this->articalRepository = $articleRepository;
    }

    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        $articles = $this->articalRepository->findAll();
        // dd($article);
        return $this->render('accueill/index.html.twig', [
            'articles'=>$articles,
            'controller_name' => 'DefaultController',
        ]);
    }



    #[Route('/services', name: 'services')]
    public function services(): Response
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/service-conception', name: 'serviceConception')]
    public function serviceConception(): Response
    {

        return $this->render('services/service-conception.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/service-tce', name: 'serviceTce')]
    public function serviceTraveau(): Response
    {

        return $this->render('services/service-traveau.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    
      #[Route('/servicetest-tce', name: 'serviceTcetest')]
    public function servicetestTraveau(): Response
    {

        return $this->render('services/servicetest-traveau.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/service-maintenance', name: 'serviceMaintenance')]
    public function serviceMaintenance(): Response
    {

        return $this->render('services/service-maintenance.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/espaces-commerciaux', name: 'espacesCommerciaux')]
    public function espacesCommerciaux(): Response
    {

        return $this->render('services/espaces-commerciaux.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }


    #[Route('/quisommesnous', name: 'quisommesnous')]
    public function Quisommesnous(): Response
    {
        return $this->render('accueill/Quisommesnous.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    // #[Route('/blog', name: 'blog')]
    // public function blog(): Response
    // {
    //     return $this->render('accueill/blog.html.twig', [
    //         'controller_name' => 'DefaultController',
    //     ]);
    // }

    

    #[Route('/contact', name: 'contact')]
    public function contact(
        Request $request): Response
    {
        
          if ($request->isMethod('POST') && $request->request->has('btn_demande_devis')) {
              
                    $this->addFlash('success', 'Votre formulaire de contact a été envoyé avec succès.');
                    return $this->redirectToRoute('accueil');
                    
          }
        
        return $this->render('contact/index.html.twig', [
          
        ]);
    }

    #[Route('/blog', name: 'blog')]
    public function blog(ArticalRepository $articalRepository, BlogRepository $BlogRepository): Response
    {
        $articles = $articalRepository->findAll();
        $blogs = $BlogRepository->findAll();
        // dd($articles);
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'DefaultController',
            'articles' => $articles,
            'blogs' => $blogs
        ]);
    }
   
    #[Route('/realisations', name: 'realisations')]
    public function realisations(RealisationsRepository $realisationsRepository): Response
    {
        $realisations = $realisationsRepository->findAll();
         $projects = [
        ['id' => 1, 'title' => 'Projet lorem ipsum', 'location' => 'Casablanca, MA', 'image' => '/path/to/image1.jpg'],
        ['id' => 2, 'title' => 'Projet lorem ipsum', 'location' => 'Rabat, MA', 'image' => '/path/to/image2.jpg'],
        // Add more projects here
    ];
        return $this->render('Realisations/index.html.twig', [
            'controller_name' => 'DefaultController',
            'realisations' => $realisations,
            'projects'=>$projects
        ]);
    }

    #[Route('/realisation/{title}', name: 'realisation')]
    public function realisation(Realisations $realisation): Response
    {
        // $realisations = $realisationsRepository->findAll();
        // dd($realisation->getImages());

        return $this->render('Realisations/realisation.html.twig', [
            'controller_name' => 'DefaultController',
            'realisation' => $realisation
        ]);
    }
    
    #[Route('/test-realisations', name: 'test_realisations')]
    public function rteealisations(RealisationsRepository $realisationsRepository): Response
    {
        $realisations = $realisationsRepository->findAll();
        return $this->render('Realisations/re.html.twig', [
            'controller_name' => 'DefaultController',
            'realisations' => $realisations
        ]);
    }


     #[Route('/conception-travaux-tce', name: 'conception_travaux_tce')]
    public function conceptionTravauxTCE(RealisationsRepository $realisationsRepository): Response
    {
        $bureaux = $this->realisationTypeRepository->findAll();
              
        $realisations = $bureaux[0]->getRealisation();
        
        return $this->render('Realisations/conception_travaux_tce.html.twig', [
            'controller_name' => 'DefaultController',
            'realisations' => $realisations,
            
        ]);
    }

    #[Route('/travaux-tce', name:'travauxTce')]
    public function travauxTCE(RealisationsRepository $realisationsRepository): Response
    {
        $administrations = $this->realisationTypeRepository->findAll();
        // dd($administrations);
              
        $realisations = $administrations[1]->getRealisation();
        
        return $this->render('Realisations/travaux_tce.html.twig', [
            'controller_name' => 'DefaultController',
            'realisations' => $realisations
        ]);
    }

    
    #[Route('/fourniture-mobilier ', name: 'fournitureMobilier')]
    public function fournitureMobilier(RealisationsRepository $realisationsRepository): Response
    {
         $commerciaux = $this->realisationTypeRepository->findAll();
        
        $realisations = $commerciaux[2]->getRealisation();
        // dd("jf");
        
        // $realisations = $realisationsRepository->findAll();
        return $this->render('Realisations/fourniture_mobilier.html.twig', [
            'controller_name' => 'DefaultController',
            'realisations' => $realisations
        ]);
    }
    
    
    // #[Route('/realisations-industriels', name: 'projets_industriels')]
    // public function projetsIndustriels(RealisationsRepository $realisationsRepository): Response
    // {
    //     $industriels = $this->realisationTypeRepository->findAll();
        
    //     $realisations = $industriels[3]->getRealisation();
    //     return $this->render('Realisations/projets_industriels.html.twig', [
    //         'controller_name' => 'DefaultController',
    //         'realisations' => $realisations
    //     ]);
    // }





    #[Route('/projet/{slug}', name: 'projet')]
    public function projet(Projet $projet): Response
    {
        // $projetRepository = $this->projetsRepository->find();

        // dd($projet);
        return $this->render('projets/projet.html.twig', [
            
            'projet'=>$projet,
           
        ]);
    }
    
    
    
    // #[Route('/espace-professionel', name: 'espaceProfessionel')]
    // public function espaceProfessionel(): Response
    // {
    //     // $projetRepository = $this->projetsRepository->find();

    //     // dd($projet);
    //     return $this->render('projets/espaceProfessionel.html.twig', [
            
            
           
    //     ]);
    // }
    
    // #[Route('/espace-fonctionnel', name: 'espaceFonctionnel')]
    // public function espaceFonctionnel(): Response
    // {
    //     // $projetRepository = $this->projetsRepository->find();

    //     // dd($projet);
    //     return $this->render('projets/espaceFonctionnel.html.twig', [
            
            
           
    //     ]);
    // }
    
    // #[Route('/gestion-projet', name: 'gestionProjet')]
    // public function gestionProjet(): Response
    // {
    //     // $projetRepository = $this->projetsRepository->find();

    //     // dd($projet);
    //     return $this->render('projets/gestionProjet.html.twig', [
            
            
           
    //     ]);
    // }
    
    
    
    
    
    
    
    
    
    
    
    
    
}
