<?php

namespace App\Controller;

use App\Entity\CtReception;
use App\Form\CtReceptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/reception")
 */
class CtReceptionController extends AbstractController
{
    /**
     * @Route("/", name="ct_reception_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctReceptions = $this->getDoctrine()
            ->getRepository(CtReception::class)
            ->findAll();

        return $this->render('ct_reception/index.html.twig', [
            'ct_receptions' => $ctReceptions,
        ]);
    }

    /**
     * @Route("/new", name="ct_reception_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctReception = new CtReception();
        $form = $this->createForm(CtReceptionType::class, $ctReception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctReception);
            $entityManager->flush();

            return $this->redirectToRoute('ct_reception_index');
        }

        return $this->render('ct_reception/new.html.twig', [
            'ct_reception' => $ctReception,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_reception_show", methods={"GET"})
     */
    public function show(CtReception $ctReception): Response
    {
        return $this->render('ct_reception/show.html.twig', [
            'ct_reception' => $ctReception,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_reception_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtReception $ctReception): Response
    {
        $form = $this->createForm(CtReceptionType::class, $ctReception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_reception_index');
        }

        return $this->render('ct_reception/edit.html.twig', [
            'ct_reception' => $ctReception,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_reception_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtReception $ctReception): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctReception->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctReception);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_reception_index');
    }
}
