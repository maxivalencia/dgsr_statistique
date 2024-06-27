<?php

namespace App\Controller;

use App\Entity\CtPlaqueChassis;
use App\Form\CtPlaqueChassisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/plaque/chassis")
 */
class CtPlaqueChassisController extends AbstractController
{
    /**
     * @Route("/", name="ct_plaque_chassis_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctPlaqueChasses = $this->getDoctrine()
            ->getRepository(CtPlaqueChassis::class)
            ->findAll();

        return $this->render('ct_plaque_chassis/index.html.twig', [
            'ct_plaque_chasses' => $ctPlaqueChasses,
        ]);
    }

    /**
     * @Route("/new", name="ct_plaque_chassis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctPlaqueChassi = new CtPlaqueChassis();
        $form = $this->createForm(CtPlaqueChassisType::class, $ctPlaqueChassi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctPlaqueChassi);
            $entityManager->flush();

            return $this->redirectToRoute('ct_plaque_chassis_index');
        }

        return $this->render('ct_plaque_chassis/new.html.twig', [
            'ct_plaque_chassi' => $ctPlaqueChassi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_plaque_chassis_show", methods={"GET"})
     */
    public function show(CtPlaqueChassis $ctPlaqueChassi): Response
    {
        return $this->render('ct_plaque_chassis/show.html.twig', [
            'ct_plaque_chassi' => $ctPlaqueChassi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_plaque_chassis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtPlaqueChassis $ctPlaqueChassi): Response
    {
        $form = $this->createForm(CtPlaqueChassisType::class, $ctPlaqueChassi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_plaque_chassis_index');
        }

        return $this->render('ct_plaque_chassis/edit.html.twig', [
            'ct_plaque_chassi' => $ctPlaqueChassi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_plaque_chassis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtPlaqueChassis $ctPlaqueChassi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctPlaqueChassi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctPlaqueChassi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_plaque_chassis_index');
    }
}
