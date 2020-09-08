<?php

namespace App\Controller;

use App\Entity\CtUsageTarif;
use App\Form\CtUsageTarifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/usagetarif")
 */
class CtUsageTarifController extends AbstractController
{
    /**
     * @Route("/", name="ct_usage_tarif_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctUsageTarifs = $this->getDoctrine()
            ->getRepository(CtUsageTarif::class)
            ->findAll();

        return $this->render('ct_usage_tarif/index.html.twig', [
            'ct_usage_tarifs' => $ctUsageTarifs,
        ]);
    }

    /**
     * @Route("/new", name="ct_usage_tarif_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctUsageTarif = new CtUsageTarif();
        $form = $this->createForm(CtUsageTarifType::class, $ctUsageTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctUsageTarif);
            $entityManager->flush();

            return $this->redirectToRoute('ct_usage_tarif_index');
        }

        return $this->render('ct_usage_tarif/new.html.twig', [
            'ct_usage_tarif' => $ctUsageTarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_usage_tarif_show", methods={"GET"})
     */
    public function show(CtUsageTarif $ctUsageTarif): Response
    {
        return $this->render('ct_usage_tarif/show.html.twig', [
            'ct_usage_tarif' => $ctUsageTarif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_usage_tarif_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtUsageTarif $ctUsageTarif): Response
    {
        $form = $this->createForm(CtUsageTarifType::class, $ctUsageTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_usage_tarif_index');
        }

        return $this->render('ct_usage_tarif/edit.html.twig', [
            'ct_usage_tarif' => $ctUsageTarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_usage_tarif_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtUsageTarif $ctUsageTarif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctUsageTarif->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctUsageTarif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_usage_tarif_index');
    }
}
