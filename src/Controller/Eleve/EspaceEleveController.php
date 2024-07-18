<?php

namespace App\Controller\Eleve;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EspaceEleveController extends AbstractController
{
    #[Route('/eleve/espace/eleve', name: 'app_eleve_espace_eleve')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $user=$this->getUser();
        $categories=$categorieRepository->findAll();

        return $this->render('eleve/espace_eleve/index.html.twig', [
            'user' => $user,
            'categories'=>$categories
        ]);
    }
}
