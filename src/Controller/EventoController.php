<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Form\EventoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/evento')]
class EventoController extends AbstractController
{
    #[Route('/', name: 'app_evento_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $eventos = $entityManager
            ->getRepository(Evento::class)
            ->findAll();

        return $this->render('evento/index.html.twig', [
            'eventos' => $eventos,
        ]);
    }

    #[Route('/new', name: 'app_evento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evento = new Evento();
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evento);
            $entityManager->flush();

            return $this->redirectToRoute('app_evento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evento/new.html.twig', [
            'evento' => $evento,
            'form' => $form,
        ]);
    }

    #[Route('/{idEvento}', name: 'app_evento_show', methods: ['GET'])]
    public function show(Evento $evento): Response
    {
        return $this->render('evento/show.html.twig', [
            'evento' => $evento,
        ]);
    }

    #[Route('/{idEvento}/edit', name: 'app_evento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evento $evento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evento/edit.html.twig', [
            'evento' => $evento,
            'form' => $form,
        ]);
    }

    #[Route('/{idEvento}', name: 'app_evento_delete', methods: ['POST'])]
    public function delete(Request $request, Evento $evento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evento->getIdEvento(), $request->request->get('_token'))) {
            $entityManager->remove($evento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evento_index', [], Response::HTTP_SEE_OTHER);
    }
}
