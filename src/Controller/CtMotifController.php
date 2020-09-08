<?php

namespace App\Controller;

use App\Entity\CtMotif;
use App\Form\CtMotifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/motif")
 */
class CtMotifController extends AbstractController
{
    /**
     * @Route("/", name="ct_motif_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctMotifs = $this->getDoctrine()
            ->getRepository(CtMotif::class)
            ->findAll();

        return $this->render('ct_motif/index.html.twig', [
            'ct_motifs' => $ctMotifs,
        ]);
    }

    /**
     * @Route("/new", name="ct_motif_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctMotif = new CtMotif();
        $form = $this->createForm(CtMotifType::class, $ctMotif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctMotif);
            $entityManager->flush();

            return $this->redirectToRoute('ct_motif_index');
        }

        return $this->render('ct_motif/new.html.twig', [
            'ct_motif' => $ctMotif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_motif_show", methods={"GET"})
     */
    public function show(CtMotif $ctMotif): Response
    {
        return $this->render('ct_motif/show.html.twig', [
            'ct_motif' => $ctMotif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_motif_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtMotif $ctMotif): Response
    {
        $form = $this->createForm(CtMotifType::class, $ctMotif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_motif_index');
        }

        return $this->render('ct_motif/edit.html.twig', [
            'ct_motif' => $ctMotif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_motif_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtMotif $ctMotif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctMotif->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctMotif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_motif_index');
    }
}
