<?php

namespace App\Controller;

use App\Entity\CtVehicule;
use App\Form\CtVehiculeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/vehicule")
 */
class CtVehiculeController extends AbstractController
{
    /**
     * @Route("/", name="ct_vehicule_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctVehicules = $this->getDoctrine()
            ->getRepository(CtVehicule::class)
            ->findAll();

        return $this->render('ct_vehicule/index.html.twig', [
            'ct_vehicules' => $ctVehicules,
        ]);
    }

    /**
     * @Route("/new", name="ct_vehicule_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctVehicule = new CtVehicule();
        $form = $this->createForm(CtVehiculeType::class, $ctVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctVehicule);
            $entityManager->flush();

            return $this->redirectToRoute('ct_vehicule_index');
        }

        return $this->render('ct_vehicule/new.html.twig', [
            'ct_vehicule' => $ctVehicule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_vehicule_show", methods={"GET"})
     */
    public function show(CtVehicule $ctVehicule): Response
    {
        return $this->render('ct_vehicule/show.html.twig', [
            'ct_vehicule' => $ctVehicule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_vehicule_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtVehicule $ctVehicule): Response
    {
        $form = $this->createForm(CtVehiculeType::class, $ctVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_vehicule_index');
        }

        return $this->render('ct_vehicule/edit.html.twig', [
            'ct_vehicule' => $ctVehicule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_vehicule_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtVehicule $ctVehicule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctVehicule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctVehicule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_vehicule_index');
    }
}
