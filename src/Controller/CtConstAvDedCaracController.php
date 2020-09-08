<?php

namespace App\Controller;

use App\Entity\CtConstAvDedCarac;
use App\Form\CtConstAvDedCaracType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/const/av/dedcarac")
 */
class CtConstAvDedCaracController extends AbstractController
{
    /**
     * @Route("/", name="ct_const_av_ded_carac_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctConstAvDedCaracs = $this->getDoctrine()
            ->getRepository(CtConstAvDedCarac::class)
            ->findAll();

        return $this->render('ct_const_av_ded_carac/index.html.twig', [
            'ct_const_av_ded_caracs' => $ctConstAvDedCaracs,
        ]);
    }

    /**
     * @Route("/new", name="ct_const_av_ded_carac_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctConstAvDedCarac = new CtConstAvDedCarac();
        $form = $this->createForm(CtConstAvDedCaracType::class, $ctConstAvDedCarac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctConstAvDedCarac);
            $entityManager->flush();

            return $this->redirectToRoute('ct_const_av_ded_carac_index');
        }

        return $this->render('ct_const_av_ded_carac/new.html.twig', [
            'ct_const_av_ded_carac' => $ctConstAvDedCarac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_const_av_ded_carac_show", methods={"GET"})
     */
    public function show(CtConstAvDedCarac $ctConstAvDedCarac): Response
    {
        return $this->render('ct_const_av_ded_carac/show.html.twig', [
            'ct_const_av_ded_carac' => $ctConstAvDedCarac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_const_av_ded_carac_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtConstAvDedCarac $ctConstAvDedCarac): Response
    {
        $form = $this->createForm(CtConstAvDedCaracType::class, $ctConstAvDedCarac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_const_av_ded_carac_index');
        }

        return $this->render('ct_const_av_ded_carac/edit.html.twig', [
            'ct_const_av_ded_carac' => $ctConstAvDedCarac,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_const_av_ded_carac_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtConstAvDedCarac $ctConstAvDedCarac): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctConstAvDedCarac->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctConstAvDedCarac);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_const_av_ded_carac_index');
    }
}
