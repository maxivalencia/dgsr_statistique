<?php

namespace App\Controller;

use App\Entity\CtCentre;
use App\Form\CtCentreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/centre")
 */
class CtCentreController extends AbstractController
{
    /**
     * @Route("/", name="ct_centre_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctCentres = $this->getDoctrine()
            ->getRepository(CtCentre::class)
            ->findAll();

        return $this->render('ct_centre/index.html.twig', [
            'ct_centres' => $ctCentres,
        ]);
    }

    /**
     * @Route("/new", name="ct_centre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctCentre = new CtCentre();
        $form = $this->createForm(CtCentreType::class, $ctCentre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctCentre);
            $entityManager->flush();

            return $this->redirectToRoute('ct_centre_index');
        }

        return $this->render('ct_centre/new.html.twig', [
            'ct_centre' => $ctCentre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_centre_show", methods={"GET"})
     */
    public function show(CtCentre $ctCentre): Response
    {
        return $this->render('ct_centre/show.html.twig', [
            'ct_centre' => $ctCentre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_centre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtCentre $ctCentre): Response
    {
        $form = $this->createForm(CtCentreType::class, $ctCentre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_centre_index');
        }

        return $this->render('ct_centre/edit.html.twig', [
            'ct_centre' => $ctCentre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_centre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtCentre $ctCentre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctCentre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctCentre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_centre_index');
    }
}
