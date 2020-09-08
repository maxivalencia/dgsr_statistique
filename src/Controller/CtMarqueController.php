<?php

namespace App\Controller;

use App\Entity\CtMarque;
use App\Form\CtMarqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/marque")
 */
class CtMarqueController extends AbstractController
{
    /**
     * @Route("/", name="ct_marque_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctMarques = $this->getDoctrine()
            ->getRepository(CtMarque::class)
            ->findAll();

        return $this->render('ct_marque/index.html.twig', [
            'ct_marques' => $ctMarques,
        ]);
    }

    /**
     * @Route("/new", name="ct_marque_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctMarque = new CtMarque();
        $form = $this->createForm(CtMarqueType::class, $ctMarque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctMarque);
            $entityManager->flush();

            return $this->redirectToRoute('ct_marque_index');
        }

        return $this->render('ct_marque/new.html.twig', [
            'ct_marque' => $ctMarque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_marque_show", methods={"GET"})
     */
    public function show(CtMarque $ctMarque): Response
    {
        return $this->render('ct_marque/show.html.twig', [
            'ct_marque' => $ctMarque,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_marque_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtMarque $ctMarque): Response
    {
        $form = $this->createForm(CtMarqueType::class, $ctMarque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_marque_index');
        }

        return $this->render('ct_marque/edit.html.twig', [
            'ct_marque' => $ctMarque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_marque_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtMarque $ctMarque): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctMarque->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctMarque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_marque_index');
    }
}
