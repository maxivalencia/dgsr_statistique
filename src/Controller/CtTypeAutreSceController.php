<?php

namespace App\Controller;

use App\Entity\CtTypeAutreSce;
use App\Form\CtTypeAutreSceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/type/autre/sce")
 */
class CtTypeAutreSceController extends AbstractController
{
    /**
     * @Route("/", name="ct_type_autre_sce_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctTypeAutreSces = $this->getDoctrine()
            ->getRepository(CtTypeAutreSce::class)
            ->findAll();

        return $this->render('ct_type_autre_sce/index.html.twig', [
            'ct_type_autre_sces' => $ctTypeAutreSces,
        ]);
    }

    /**
     * @Route("/new", name="ct_type_autre_sce_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctTypeAutreSce = new CtTypeAutreSce();
        $form = $this->createForm(CtTypeAutreSceType::class, $ctTypeAutreSce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctTypeAutreSce);
            $entityManager->flush();

            return $this->redirectToRoute('ct_type_autre_sce_index');
        }

        return $this->render('ct_type_autre_sce/new.html.twig', [
            'ct_type_autre_sce' => $ctTypeAutreSce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_autre_sce_show", methods={"GET"})
     */
    public function show(CtTypeAutreSce $ctTypeAutreSce): Response
    {
        return $this->render('ct_type_autre_sce/show.html.twig', [
            'ct_type_autre_sce' => $ctTypeAutreSce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_type_autre_sce_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtTypeAutreSce $ctTypeAutreSce): Response
    {
        $form = $this->createForm(CtTypeAutreSceType::class, $ctTypeAutreSce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_type_autre_sce_index');
        }

        return $this->render('ct_type_autre_sce/edit.html.twig', [
            'ct_type_autre_sce' => $ctTypeAutreSce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_autre_sce_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtTypeAutreSce $ctTypeAutreSce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTypeAutreSce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctTypeAutreSce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_type_autre_sce_index');
    }
}
