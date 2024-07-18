<?php

namespace App\Controller\Moniteur;

use App\Entity\Licence;
use App\Form\LicenceType;
use App\Repository\LicenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/moniteur/licence')]
class LicenceController extends AbstractController
{
    #[Route('/', name: 'app_moniteur_licence_index', methods: ['GET'])]
    public function index(LicenceRepository $licenceRepository): Response
    {
        return $this->render('moniteur/licence/index.html.twig', [
            'licences' => $licenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_moniteur_licence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $licence = new Licence();
        $form = $this->createForm(LicenceType::class, $licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($licence);
            $entityManager->flush();

            return $this->redirectToRoute('app_moniteur_licence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moniteur/licence/new.html.twig', [
            'licence' => $licence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_moniteur_licence_show', methods: ['GET'])]
    public function show(Licence $licence): Response
    {
        return $this->render('moniteur/licence/show.html.twig', [
            'licence' => $licence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_moniteur_licence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Licence $licence, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LicenceType::class, $licence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_moniteur_licence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moniteur/licence/edit.html.twig', [
            'licence' => $licence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_moniteur_licence_delete', methods: ['POST'])]
    public function delete(Request $request, Licence $licence, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$licence->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($licence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_moniteur_licence_index', [], Response::HTTP_SEE_OTHER);
    }
}
