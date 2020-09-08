<?php

namespace App\Controller;

use App\Entity\CtUtilisation;
use App\Form\CtUtilisationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/utilisation")
 */
class CtUtilisationController extends AbstractController
{
    /**
     * @Route("/", name="ct_utilisation_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctUtilisations = $this->getDoctrine()
            ->getRepository(CtUtilisation::class)
            ->findAll();

        return $this->render('ct_utilisation/index.html.twig', [
            'ct_utilisations' => $ctUtilisations,
        ]);
    }

    /**
     * @Route("/new", name="ct_utilisation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctUtilisation = new CtUtilisation();
        $form = $this->createForm(CtUtilisationType::class, $ctUtilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctUtilisation);
            $entityManager->flush();

            return $this->redirectToRoute('ct_utilisation_index');
        }

        return $this->render('ct_utilisation/new.html.twig', [
            'ct_utilisation' => $ctUtilisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_utilisation_show", methods={"GET"})
     */
    public function show(CtUtilisation $ctUtilisation): Response
    {
        return $this->render('ct_utilisation/show.html.twig', [
            'ct_utilisation' => $ctUtilisation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_utilisation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtUtilisation $ctUtilisation): Response
    {
        $form = $this->createForm(CtUtilisationType::class, $ctUtilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_utilisation_index');
        }

        return $this->render('ct_utilisation/edit.html.twig', [
            'ct_utilisation' => $ctUtilisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_utilisation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtUtilisation $ctUtilisation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctUtilisation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctUtilisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_utilisation_index');
    }
}
