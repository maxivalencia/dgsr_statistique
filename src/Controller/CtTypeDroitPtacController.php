<?php

namespace App\Controller;

use App\Entity\CtTypeDroitPtac;
use App\Form\CtTypeDroitPtacType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/type/droit/ptac")
 */
class CtTypeDroitPtacController extends AbstractController
{
    /**
     * @Route("/", name="ct_type_droit_ptac_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctTypeDroitPtacs = $this->getDoctrine()
            ->getRepository(CtTypeDroitPtac::class)
            ->findAll();

        return $this->render('ct_type_droit_ptac/index.html.twig', [
            'ct_type_droit_ptacs' => $ctTypeDroitPtacs,
        ]);
    }

    /**
     * @Route("/new", name="ct_type_droit_ptac_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctTypeDroitPtac = new CtTypeDroitPtac();
        $form = $this->createForm(CtTypeDroitPtacType::class, $ctTypeDroitPtac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctTypeDroitPtac);
            $entityManager->flush();

            return $this->redirectToRoute('ct_type_droit_ptac_index');
        }

        return $this->render('ct_type_droit_ptac/new.html.twig', [
            'ct_type_droit_ptac' => $ctTypeDroitPtac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_droit_ptac_show", methods={"GET"})
     */
    public function show(CtTypeDroitPtac $ctTypeDroitPtac): Response
    {
        return $this->render('ct_type_droit_ptac/show.html.twig', [
            'ct_type_droit_ptac' => $ctTypeDroitPtac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_type_droit_ptac_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtTypeDroitPtac $ctTypeDroitPtac): Response
    {
        $form = $this->createForm(CtTypeDroitPtacType::class, $ctTypeDroitPtac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_type_droit_ptac_index');
        }

        return $this->render('ct_type_droit_ptac/edit.html.twig', [
            'ct_type_droit_ptac' => $ctTypeDroitPtac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_droit_ptac_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtTypeDroitPtac $ctTypeDroitPtac): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTypeDroitPtac->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctTypeDroitPtac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_type_droit_ptac_index');
    }
}
