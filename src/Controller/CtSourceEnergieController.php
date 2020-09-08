<?php

namespace App\Controller;

use App\Entity\CtSourceEnergie;
use App\Form\CtSourceEnergieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/source/energie")
 */
class CtSourceEnergieController extends AbstractController
{
    /**
     * @Route("/", name="ct_source_energie_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctSourceEnergies = $this->getDoctrine()
            ->getRepository(CtSourceEnergie::class)
            ->findAll();

        return $this->render('ct_source_energie/index.html.twig', [
            'ct_source_energies' => $ctSourceEnergies,
        ]);
    }

    /**
     * @Route("/new", name="ct_source_energie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctSourceEnergie = new CtSourceEnergie();
        $form = $this->createForm(CtSourceEnergieType::class, $ctSourceEnergie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctSourceEnergie);
            $entityManager->flush();

            return $this->redirectToRoute('ct_source_energie_index');
        }

        return $this->render('ct_source_energie/new.html.twig', [
            'ct_source_energie' => $ctSourceEnergie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_source_energie_show", methods={"GET"})
     */
    public function show(CtSourceEnergie $ctSourceEnergie): Response
    {
        return $this->render('ct_source_energie/show.html.twig', [
            'ct_source_energie' => $ctSourceEnergie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_source_energie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtSourceEnergie $ctSourceEnergie): Response
    {
        $form = $this->createForm(CtSourceEnergieType::class, $ctSourceEnergie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_source_energie_index');
        }

        return $this->render('ct_source_energie/edit.html.twig', [
            'ct_source_energie' => $ctSourceEnergie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_source_energie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtSourceEnergie $ctSourceEnergie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctSourceEnergie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctSourceEnergie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_source_energie_index');
    }
}
