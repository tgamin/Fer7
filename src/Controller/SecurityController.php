<?php

namespace App\Controller;

use App\Entity\Artical;
use App\Entity\Projet;
use App\Entity\Realisations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\ArticalRepository;
use App\Repository\BlogRepository;
use App\Repository\ProjetRepository;
use App\Repository\RealisationsRepository;
use App\Repository\RealisationTypeRepository;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    
    private $projetsRepository, $realisationTypeRepository, $articleRepository;

    public function __construct(ProjetRepository $projetRepository, RealisationTypeRepository $realisationTypeRepository, ArticalRepository $articleRepository)
    {
        $this->projetsRepository = $projetRepository;
        $this->realisationTypeRepository = $realisationTypeRepository;
        $this->articalRepository = $articleRepository;
    }

    
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    #[Route('/{slug}', name: 'article')]
    public function articles(Artical $article): Response
    {
        // dd($article);
        $allArticles = $this->articalRepository->findAll();
        
        return $this->render('accueill/article.html.twig', [
            'articles'=>$allArticles,
            'article'=>$article,
            'controller_name' => 'DefaultController',
        ]);
    }
}
