<?php

namespace App\Controller;

use App\Entity\CtDroitPtac;
use App\Form\CtDroitPtacType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/droit/ptac")
 */
class CtDroitPtacController extends AbstractController
{
    /**
     * @Route("/", name="ct_droit_ptac_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctDroitPtacs = $this->getDoctrine()
            ->getRepository(CtDroitPtac::class)
            ->findAll();

        return $this->render('ct_droit_ptac/index.html.twig', [
            'ct_droit_ptacs' => $ctDroitPtacs,
        ]);
    }

    /**
     * @Route("/new", name="ct_droit_ptac_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctDroitPtac = new CtDroitPtac();
        $form = $this->createForm(CtDroitPtacType::class, $ctDroitPtac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctDroitPtac);
            $entityManager->flush();

            return $this->redirectToRoute('ct_droit_ptac_index');
        }

        return $this->render('ct_droit_ptac/new.html.twig', [
            'ct_droit_ptac' => $ctDroitPtac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_droit_ptac_show", methods={"GET"})
     */
    public function show(CtDroitPtac $ctDroitPtac): Response
    {
        return $this->render('ct_droit_ptac/show.html.twig', [
            'ct_droit_ptac' => $ctDroitPtac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_droit_ptac_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtDroitPtac $ctDroitPtac): Response
    {
        $form = $this->createForm(CtDroitPtacType::class, $ctDroitPtac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_droit_ptac_index');
        }

        return $this->render('ct_droit_ptac/edit.html.twig', [
            'ct_droit_ptac' => $ctDroitPtac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_droit_ptac_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtDroitPtac $ctDroitPtac): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctDroitPtac->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctDroitPtac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_droit_ptac_index');
    }
}
