<?php

namespace App\Controller;

use App\Entity\CtAnomalie;
use App\Form\CtAnomalieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/anomalie")
 */
class CtAnomalieController extends AbstractController
{
    /**
     * @Route("/", name="ct_anomalie_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctAnomalies = $this->getDoctrine()
            ->getRepository(CtAnomalie::class)
            ->findAll();

        return $this->render('ct_anomalie/index.html.twig', [
            'ct_anomalies' => $ctAnomalies,
        ]);
    }

    /**
     * @Route("/new", name="ct_anomalie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctAnomalie = new CtAnomalie();
        $form = $this->createForm(CtAnomalieType::class, $ctAnomalie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctAnomalie);
            $entityManager->flush();

            return $this->redirectToRoute('ct_anomalie_index');
        }

        return $this->render('ct_anomalie/new.html.twig', [
            'ct_anomalie' => $ctAnomalie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_anomalie_show", methods={"GET"})
     */
    public function show(CtAnomalie $ctAnomalie): Response
    {
        return $this->render('ct_anomalie/show.html.twig', [
            'ct_anomalie' => $ctAnomalie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_anomalie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtAnomalie $ctAnomalie): Response
    {
        $form = $this->createForm(CtAnomalieType::class, $ctAnomalie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_anomalie_index');
        }

        return $this->render('ct_anomalie/edit.html.twig', [
            'ct_anomalie' => $ctAnomalie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_anomalie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtAnomalie $ctAnomalie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctAnomalie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctAnomalie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_anomalie_index');
    }
}
