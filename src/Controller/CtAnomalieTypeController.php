<?php

namespace App\Controller;

use App\Entity\CtAnomalieType;
use App\Form\CtAnomalieTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/anomalietype")
 */
class CtAnomalieTypeController extends AbstractController
{
    /**
     * @Route("/", name="ct_anomalie_type_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctAnomalieTypes = $this->getDoctrine()
            ->getRepository(CtAnomalieType::class)
            ->findAll();

        return $this->render('ct_anomalie_type/index.html.twig', [
            'ct_anomalie_types' => $ctAnomalieTypes,
        ]);
    }

    /**
     * @Route("/new", name="ct_anomalie_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctAnomalieType = new CtAnomalieType();
        $form = $this->createForm(CtAnomalieTypeType::class, $ctAnomalieType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctAnomalieType);
            $entityManager->flush();

            return $this->redirectToRoute('ct_anomalie_type_index');
        }

        return $this->render('ct_anomalie_type/new.html.twig', [
            'ct_anomalie_type' => $ctAnomalieType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_anomalie_type_show", methods={"GET"})
     */
    public function show(CtAnomalieType $ctAnomalieType): Response
    {
        return $this->render('ct_anomalie_type/show.html.twig', [
            'ct_anomalie_type' => $ctAnomalieType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_anomalie_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtAnomalieType $ctAnomalieType): Response
    {
        $form = $this->createForm(CtAnomalieTypeType::class, $ctAnomalieType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_anomalie_type_index');
        }

        return $this->render('ct_anomalie_type/edit.html.twig', [
            'ct_anomalie_type' => $ctAnomalieType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_anomalie_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtAnomalieType $ctAnomalieType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctAnomalieType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctAnomalieType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_anomalie_type_index');
    }
}
