<?php

namespace App\Controller;

use App\Entity\CtZoneDeserte;
use App\Form\CtZoneDeserteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/zone/deserte")
 */
class CtZoneDeserteController extends AbstractController
{
    /**
     * @Route("/", name="ct_zone_deserte_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctZoneDesertes = $this->getDoctrine()
            ->getRepository(CtZoneDeserte::class)
            ->findAll();

        return $this->render('ct_zone_deserte/index.html.twig', [
            'ct_zone_desertes' => $ctZoneDesertes,
        ]);
    }

    /**
     * @Route("/new", name="ct_zone_deserte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctZoneDeserte = new CtZoneDeserte();
        $form = $this->createForm(CtZoneDeserteType::class, $ctZoneDeserte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctZoneDeserte);
            $entityManager->flush();

            return $this->redirectToRoute('ct_zone_deserte_index');
        }

        return $this->render('ct_zone_deserte/new.html.twig', [
            'ct_zone_deserte' => $ctZoneDeserte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_zone_deserte_show", methods={"GET"})
     */
    public function show(CtZoneDeserte $ctZoneDeserte): Response
    {
        return $this->render('ct_zone_deserte/show.html.twig', [
            'ct_zone_deserte' => $ctZoneDeserte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_zone_deserte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtZoneDeserte $ctZoneDeserte): Response
    {
        $form = $this->createForm(CtZoneDeserteType::class, $ctZoneDeserte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_zone_deserte_index');
        }

        return $this->render('ct_zone_deserte/edit.html.twig', [
            'ct_zone_deserte' => $ctZoneDeserte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_zone_deserte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtZoneDeserte $ctZoneDeserte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctZoneDeserte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctZoneDeserte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_zone_deserte_index');
    }
}
