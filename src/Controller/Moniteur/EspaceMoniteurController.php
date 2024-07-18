<?php

namespace App\Controller\Moniteur;

use App\Repository\CategorieRepository;
use App\Repository\LicenceRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EspaceMoniteurController extends AbstractController
{
    #[Route('/moniteur/espace/moniteur', name: 'app_moniteur_espace_moniteur')]
    public function index(CategorieRepository $categorieRepository,
                          VehiculeRepository $vehiculeRepository,
                            LicenceRepository $licenceRepository): Response
    {
        $user=$this->getUser();
        $categories=$categorieRepository->findAll();
        $vehicules=$vehiculeRepository->findAll();
        $licences=$licenceRepository->findBy(['code_moniteur'=>$this->getUser()->getId()]);
        return $this->render('moniteur/espace_moniteur/index.html.twig', [
            'user' => $user,
            'categories' => $categories,
            'vehicules' => $vehicules,
            'licences'=>$licences
        ]);
    }
}
