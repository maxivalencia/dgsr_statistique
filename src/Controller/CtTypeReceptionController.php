<?php

namespace App\Controller;

use App\Entity\CtTypeReception;
use App\Form\CtTypeReceptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/type/reception")
 */
class CtTypeReceptionController extends AbstractController
{
    /**
     * @Route("/", name="ct_type_reception_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctTypeReceptions = $this->getDoctrine()
            ->getRepository(CtTypeReception::class)
            ->findAll();

        return $this->render('ct_type_reception/index.html.twig', [
            'ct_type_receptions' => $ctTypeReceptions,
        ]);
    }

    /**
     * @Route("/new", name="ct_type_reception_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctTypeReception = new CtTypeReception();
        $form = $this->createForm(CtTypeReceptionType::class, $ctTypeReception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctTypeReception);
            $entityManager->flush();

            return $this->redirectToRoute('ct_type_reception_index');
        }

        return $this->render('ct_type_reception/new.html.twig', [
            'ct_type_reception' => $ctTypeReception,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_reception_show", methods={"GET"})
     */
    public function show(CtTypeReception $ctTypeReception): Response
    {
        return $this->render('ct_type_reception/show.html.twig', [
            'ct_type_reception' => $ctTypeReception,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_type_reception_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtTypeReception $ctTypeReception): Response
    {
        $form = $this->createForm(CtTypeReceptionType::class, $ctTypeReception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_type_reception_index');
        }

        return $this->render('ct_type_reception/edit.html.twig', [
            'ct_type_reception' => $ctTypeReception,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_reception_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtTypeReception $ctTypeReception): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTypeReception->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctTypeReception);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_type_reception_index');
    }
}
