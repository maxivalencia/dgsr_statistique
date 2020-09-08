<?php

namespace App\Controller;

use App\Entity\CtVisiteAnomalie;
use App\Form\CtVisiteAnomalieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/visite/anomalie")
 */
class CtVisiteAnomalieController extends AbstractController
{
    /**
     * @Route("/", name="ct_visite_anomalie_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctVisiteAnomalies = $this->getDoctrine()
            ->getRepository(CtVisiteAnomalie::class)
            ->findAll();

        return $this->render('ct_visite_anomalie/index.html.twig', [
            'ct_visite_anomalies' => $ctVisiteAnomalies,
        ]);
    }

    /**
     * @Route("/new", name="ct_visite_anomalie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctVisiteAnomalie = new CtVisiteAnomalie();
        $form = $this->createForm(CtVisiteAnomalieType::class, $ctVisiteAnomalie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctVisiteAnomalie);
            $entityManager->flush();

            return $this->redirectToRoute('ct_visite_anomalie_index');
        }

        return $this->render('ct_visite_anomalie/new.html.twig', [
            'ct_visite_anomalie' => $ctVisiteAnomalie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_anomalie_show", methods={"GET"})
     */
    public function show(CtVisiteAnomalie $ctVisiteAnomalie): Response
    {
        return $this->render('ct_visite_anomalie/show.html.twig', [
            'ct_visite_anomalie' => $ctVisiteAnomalie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_visite_anomalie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtVisiteAnomalie $ctVisiteAnomalie): Response
    {
        $form = $this->createForm(CtVisiteAnomalieType::class, $ctVisiteAnomalie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_visite_anomalie_index');
        }

        return $this->render('ct_visite_anomalie/edit.html.twig', [
            'ct_visite_anomalie' => $ctVisiteAnomalie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_anomalie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtVisiteAnomalie $ctVisiteAnomalie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctVisiteAnomalie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctVisiteAnomalie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_visite_anomalie_index');
    }
}
