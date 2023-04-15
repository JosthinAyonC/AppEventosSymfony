<?php

namespace App\Controller;

use App\Entity\Cotizacion;
use App\Entity\Item;
use App\Form\CotizacionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cotizacion')]
class CotizacionController extends AbstractController
{
    #[Route('/', name: 'app_cotizacion_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cotizacions = $entityManager
            ->getRepository(Cotizacion::class)
            ->findAll();

        return $this->render('cotizacion/index.html.twig', [
            'cotizacions' => $cotizacions,
        ]);
    }

    #[Route('/new', name: 'app_cotizacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cotizacion = new Cotizacion();

        

        $form = $this->createForm(CotizacionType::class, $cotizacion);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $cotizacion->setIdUsuario($this->getUser());
            $entityManager->persist($cotizacion);
            $entityManager->flush();

            $itemId = $cotizacion->getIdItem();
            $item = $entityManager->getRepository(Item::class)->find($itemId);
            $precioItem = $item->getPrecioItem();
            $cotizacion->setCostoCotizacion(($cotizacion->getCantItems())*($precioItem));
            $entityManager->persist($cotizacion);
            $entityManager->flush();

            $this->addFlash('sucess', 'Cotizacion realizada correctamente');

        }


        return $this->renderForm('cotizacion/new.html.twig', [
            'cotizacion' => $cotizacion,
            'form' => $form,
        ]);
    }

    #[Route('/{idCotizacion}', name: 'app_cotizacion_show', methods: ['GET'])]
    public function show(Cotizacion $cotizacion): Response
    {
        return $this->render('cotizacion/show.html.twig', [
            'cotizacion' => $cotizacion,
        ]);
    }

    #[Route('/{idCotizacion}/edit', name: 'app_cotizacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cotizacion $cotizacion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CotizacionType::class, $cotizacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cotizacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cotizacion/edit.html.twig', [
            'cotizacion' => $cotizacion,
            'form' => $form,
        ]);
    }

    #[Route('/{idCotizacion}', name: 'app_cotizacion_delete', methods: ['POST'])]
    public function delete(Request $request, Cotizacion $cotizacion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cotizacion->getIdCotizacion(), $request->request->get('_token'))) {
            $entityManager->remove($cotizacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cotizacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
