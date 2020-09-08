<?php

namespace App\Controller;

use App\Entity\CtConstAvDedType;
use App\Form\CtConstAvDedTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/const/av/dedtype")
 */
class CtConstAvDedTypeController extends AbstractController
{
    /**
     * @Route("/", name="ct_const_av_ded_type_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctConstAvDedTypes = $this->getDoctrine()
            ->getRepository(CtConstAvDedType::class)
            ->findAll();

        return $this->render('ct_const_av_ded_type/index.html.twig', [
            'ct_const_av_ded_types' => $ctConstAvDedTypes,
        ]);
    }

    /**
     * @Route("/new", name="ct_const_av_ded_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctConstAvDedType = new CtConstAvDedType();
        $form = $this->createForm(CtConstAvDedTypeType::class, $ctConstAvDedType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctConstAvDedType);
            $entityManager->flush();

            return $this->redirectToRoute('ct_const_av_ded_type_index');
        }

        return $this->render('ct_const_av_ded_type/new.html.twig', [
            'ct_const_av_ded_type' => $ctConstAvDedType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_const_av_ded_type_show", methods={"GET"})
     */
    public function show(CtConstAvDedType $ctConstAvDedType): Response
    {
        return $this->render('ct_const_av_ded_type/show.html.twig', [
            'ct_const_av_ded_type' => $ctConstAvDedType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_const_av_ded_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtConstAvDedType $ctConstAvDedType): Response
    {
        $form = $this->createForm(CtConstAvDedTypeType::class, $ctConstAvDedType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_const_av_ded_type_index');
        }

        return $this->render('ct_const_av_ded_type/edit.html.twig', [
            'ct_const_av_ded_type' => $ctConstAvDedType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_const_av_ded_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtConstAvDedType $ctConstAvDedType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctConstAvDedType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctConstAvDedType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_const_av_ded_type_index');
    }
}
