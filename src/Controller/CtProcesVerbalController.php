<?php

namespace App\Controller;

use App\Entity\CtProcesVerbal;
use App\Form\CtProcesVerbalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/proces/verbal")
 */
class CtProcesVerbalController extends AbstractController
{
    /**
     * @Route("/", name="ct_proces_verbal_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctProcesVerbals = $this->getDoctrine()
            ->getRepository(CtProcesVerbal::class)
            ->findAll();

        return $this->render('ct_proces_verbal/index.html.twig', [
            'ct_proces_verbals' => $ctProcesVerbals,
        ]);
    }

    /**
     * @Route("/new", name="ct_proces_verbal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctProcesVerbal = new CtProcesVerbal();
        $form = $this->createForm(CtProcesVerbalType::class, $ctProcesVerbal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctProcesVerbal);
            $entityManager->flush();

            return $this->redirectToRoute('ct_proces_verbal_index');
        }

        return $this->render('ct_proces_verbal/new.html.twig', [
            'ct_proces_verbal' => $ctProcesVerbal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_proces_verbal_show", methods={"GET"})
     */
    public function show(CtProcesVerbal $ctProcesVerbal): Response
    {
        return $this->render('ct_proces_verbal/show.html.twig', [
            'ct_proces_verbal' => $ctProcesVerbal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_proces_verbal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtProcesVerbal $ctProcesVerbal): Response
    {
        $form = $this->createForm(CtProcesVerbalType::class, $ctProcesVerbal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_proces_verbal_index');
        }

        return $this->render('ct_proces_verbal/edit.html.twig', [
            'ct_proces_verbal' => $ctProcesVerbal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_proces_verbal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtProcesVerbal $ctProcesVerbal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctProcesVerbal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctProcesVerbal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_proces_verbal_index');
    }
}
