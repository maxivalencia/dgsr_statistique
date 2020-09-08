<?php

namespace App\Controller;

use App\Entity\CtVisiteExtraTarif;
use App\Form\CtVisiteExtraTarifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/visiteextratarif")
 */
class CtVisiteExtraTarifController extends AbstractController
{
    /**
     * @Route("/", name="ct_visite_extra_tarif_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctVisiteExtraTarifs = $this->getDoctrine()
            ->getRepository(CtVisiteExtraTarif::class)
            ->findAll();

        return $this->render('ct_visite_extra_tarif/index.html.twig', [
            'ct_visite_extra_tarifs' => $ctVisiteExtraTarifs,
        ]);
    }

    /**
     * @Route("/new", name="ct_visite_extra_tarif_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctVisiteExtraTarif = new CtVisiteExtraTarif();
        $form = $this->createForm(CtVisiteExtraTarifType::class, $ctVisiteExtraTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctVisiteExtraTarif);
            $entityManager->flush();

            return $this->redirectToRoute('ct_visite_extra_tarif_index');
        }

        return $this->render('ct_visite_extra_tarif/new.html.twig', [
            'ct_visite_extra_tarif' => $ctVisiteExtraTarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_extra_tarif_show", methods={"GET"})
     */
    public function show(CtVisiteExtraTarif $ctVisiteExtraTarif): Response
    {
        return $this->render('ct_visite_extra_tarif/show.html.twig', [
            'ct_visite_extra_tarif' => $ctVisiteExtraTarif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_visite_extra_tarif_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtVisiteExtraTarif $ctVisiteExtraTarif): Response
    {
        $form = $this->createForm(CtVisiteExtraTarifType::class, $ctVisiteExtraTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_visite_extra_tarif_index');
        }

        return $this->render('ct_visite_extra_tarif/edit.html.twig', [
            'ct_visite_extra_tarif' => $ctVisiteExtraTarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_extra_tarif_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtVisiteExtraTarif $ctVisiteExtraTarif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctVisiteExtraTarif->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctVisiteExtraTarif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_visite_extra_tarif_index');
    }
}
