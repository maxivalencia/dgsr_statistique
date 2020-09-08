<?php

namespace App\Controller;

use App\Entity\CtMotifTarif;
use App\Form\CtMotifTarifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/motiftarif")
 */
class CtMotifTarifController extends AbstractController
{
    /**
     * @Route("/", name="ct_motif_tarif_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctMotifTarifs = $this->getDoctrine()
            ->getRepository(CtMotifTarif::class)
            ->findAll();

        return $this->render('ct_motif_tarif/index.html.twig', [
            'ct_motif_tarifs' => $ctMotifTarifs,
        ]);
    }

    /**
     * @Route("/new", name="ct_motif_tarif_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctMotifTarif = new CtMotifTarif();
        $form = $this->createForm(CtMotifTarifType::class, $ctMotifTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctMotifTarif);
            $entityManager->flush();

            return $this->redirectToRoute('ct_motif_tarif_index');
        }

        return $this->render('ct_motif_tarif/new.html.twig', [
            'ct_motif_tarif' => $ctMotifTarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_motif_tarif_show", methods={"GET"})
     */
    public function show(CtMotifTarif $ctMotifTarif): Response
    {
        return $this->render('ct_motif_tarif/show.html.twig', [
            'ct_motif_tarif' => $ctMotifTarif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_motif_tarif_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtMotifTarif $ctMotifTarif): Response
    {
        $form = $this->createForm(CtMotifTarifType::class, $ctMotifTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_motif_tarif_index');
        }

        return $this->render('ct_motif_tarif/edit.html.twig', [
            'ct_motif_tarif' => $ctMotifTarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_motif_tarif_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtMotifTarif $ctMotifTarif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctMotifTarif->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctMotifTarif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_motif_tarif_index');
    }
}
