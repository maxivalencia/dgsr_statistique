<?php

namespace App\Controller;

use App\Entity\CtArretePrix;
use App\Form\CtArretePrixType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/arrete/prix")
 */
class CtArretePrixController extends AbstractController
{
    /**
     * @Route("/", name="ct_arrete_prix_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctArretePrixes = $this->getDoctrine()
            ->getRepository(CtArretePrix::class)
            ->findAll();

        return $this->render('ct_arrete_prix/index.html.twig', [
            'ct_arrete_prixes' => $ctArretePrixes,
        ]);
    }

    /**
     * @Route("/new", name="ct_arrete_prix_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctArretePrix = new CtArretePrix();
        $form = $this->createForm(CtArretePrixType::class, $ctArretePrix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctArretePrix);
            $entityManager->flush();

            return $this->redirectToRoute('ct_arrete_prix_index');
        }

        return $this->render('ct_arrete_prix/new.html.twig', [
            'ct_arrete_prix' => $ctArretePrix,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_arrete_prix_show", methods={"GET"})
     */
    public function show(CtArretePrix $ctArretePrix): Response
    {
        return $this->render('ct_arrete_prix/show.html.twig', [
            'ct_arrete_prix' => $ctArretePrix,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_arrete_prix_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtArretePrix $ctArretePrix): Response
    {
        $form = $this->createForm(CtArretePrixType::class, $ctArretePrix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_arrete_prix_index');
        }

        return $this->render('ct_arrete_prix/edit.html.twig', [
            'ct_arrete_prix' => $ctArretePrix,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_arrete_prix_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtArretePrix $ctArretePrix): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctArretePrix->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctArretePrix);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_arrete_prix_index');
    }
}
