<?php

namespace App\Controller;

use App\Entity\CtAutreSce;
use App\Form\CtAutreSceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/autre/sce")
 */
class CtAutreSceController extends AbstractController
{
    /**
     * @Route("/", name="ct_autre_sce_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctAutreSces = $this->getDoctrine()
            ->getRepository(CtAutreSce::class)
            ->findAll();

        return $this->render('ct_autre_sce/index.html.twig', [
            'ct_autre_sces' => $ctAutreSces,
        ]);
    }

    /**
     * @Route("/new", name="ct_autre_sce_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctAutreSce = new CtAutreSce();
        $form = $this->createForm(CtAutreSceType::class, $ctAutreSce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctAutreSce);
            $entityManager->flush();

            return $this->redirectToRoute('ct_autre_sce_index');
        }

        return $this->render('ct_autre_sce/new.html.twig', [
            'ct_autre_sce' => $ctAutreSce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_autre_sce_show", methods={"GET"})
     */
    public function show(CtAutreSce $ctAutreSce): Response
    {
        return $this->render('ct_autre_sce/show.html.twig', [
            'ct_autre_sce' => $ctAutreSce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_autre_sce_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtAutreSce $ctAutreSce): Response
    {
        $form = $this->createForm(CtAutreSceType::class, $ctAutreSce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_autre_sce_index');
        }

        return $this->render('ct_autre_sce/edit.html.twig', [
            'ct_autre_sce' => $ctAutreSce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_autre_sce_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtAutreSce $ctAutreSce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctAutreSce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctAutreSce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_autre_sce_index');
    }
}
