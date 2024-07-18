<?php

namespace App\Controller\Eleve;

use App\Entity\Lecon;
use App\Form\LeconType;
use App\Repository\LeconRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;

#[Route('/eleve/lecon')]
class LeconController extends AbstractController
{
    #[Route('/', name: 'app_eleve_lecon_index', methods: ['GET'])]
    public function index(LeconRepository $leconRepository): Response
    {
      $lecons=[];
      if (in_array("ROLE_ELEVE",$this->getUser()->getRoles())){
          $lecons=$leconRepository->findBy([
              'code_eleve'=>$this->getUser()->getId()
          ]);
      }
      elseif (in_array("ROLE_MONITEUR",$this->getUser()->getRoles())){
          $lecons=$leconRepository->findAll();
      }
        return $this->render('eleve/lecon/index.html.twig', [
            'lecons' => $lecons,
        ]);
    }

    #[Route('/path/mylecons', name: 'app_calend_eleve_lecon', methods: ['GET'])]
    public function events(LeconRepository $leconRepository): JsonResponse
    {
        $lecons=[];
        if (in_array("ROLE_ELEVE",$this->getUser()->getRoles())){
            $lecons=$leconRepository->findBy([
                'code_eleve'=>$this->getUser()->getId()
            ]);
        }
        elseif (in_array("ROLE_MONITEUR",$this->getUser()->getRoles())){
            $lecons=$leconRepository->findAll();
        }
        $data = array_map(function ($lecon) {
            $rdvDateTime = $lecon->getRdv(); // Suppose que getRdv() renvoie un objet DateTime
            return [
                'title' => $lecon->getCodeMoniteur()->getNom() + $lecon->getCodeMoniteur()->getPrenom(),
                'start' => $rdvDateTime->format('Y-m-d\TH:i:s'), // Format ISO 8601
                'end' => $rdvDateTime->modify('+1 hour')->format('Y-m-d\TH:i:s') // Ajoute une heure à l'heure de début pour l'heure de fin
            ];
        }, $lecons);

        return new JsonResponse($data);
    }

    #[Route('/new', name: 'app_eleve_lecon_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lecon = new Lecon();
        $lecon->setCodeEleve($this->getUser());
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lecon);
            $entityManager->flush();

            return $this->redirectToRoute('app_eleve_lecon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('eleve/lecon/new.html.twig', [
            'lecon' => $lecon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eleve_lecon_show', methods: ['GET'])]
    public function show(Lecon $lecon): Response
    {
        return $this->render('eleve/lecon/show.html.twig', [
            'lecon' => $lecon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_eleve_lecon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_eleve_lecon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('eleve/lecon/edit.html.twig', [
            'lecon' => $lecon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_eleve_lecon_delete', methods: ['POST'])]
    public function delete(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lecon->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($lecon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_eleve_lecon_index', [], Response::HTTP_SEE_OTHER);
    }
}
