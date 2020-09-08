<?php

namespace App\Controller;

use App\Entity\CtDroitPtacBak;
use App\Form\CtDroitPtacBakType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/droit/ptacbak")
 */
class CtDroitPtacBakController extends AbstractController
{
    /**
     * @Route("/", name="ct_droit_ptac_bak_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctDroitPtacBaks = $this->getDoctrine()
            ->getRepository(CtDroitPtacBak::class)
            ->findAll();

        return $this->render('ct_droit_ptac_bak/index.html.twig', [
            'ct_droit_ptac_baks' => $ctDroitPtacBaks,
        ]);
    }

    /**
     * @Route("/new", name="ct_droit_ptac_bak_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctDroitPtacBak = new CtDroitPtacBak();
        $form = $this->createForm(CtDroitPtacBakType::class, $ctDroitPtacBak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctDroitPtacBak);
            $entityManager->flush();

            return $this->redirectToRoute('ct_droit_ptac_bak_index');
        }

        return $this->render('ct_droit_ptac_bak/new.html.twig', [
            'ct_droit_ptac_bak' => $ctDroitPtacBak,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_droit_ptac_bak_show", methods={"GET"})
     */
    public function show(CtDroitPtacBak $ctDroitPtacBak): Response
    {
        return $this->render('ct_droit_ptac_bak/show.html.twig', [
            'ct_droit_ptac_bak' => $ctDroitPtacBak,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_droit_ptac_bak_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtDroitPtacBak $ctDroitPtacBak): Response
    {
        $form = $this->createForm(CtDroitPtacBakType::class, $ctDroitPtacBak);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_droit_ptac_bak_index');
        }

        return $this->render('ct_droit_ptac_bak/edit.html.twig', [
            'ct_droit_ptac_bak' => $ctDroitPtacBak,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_droit_ptac_bak_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtDroitPtacBak $ctDroitPtacBak): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctDroitPtacBak->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctDroitPtacBak);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_droit_ptac_bak_index');
    }
}
