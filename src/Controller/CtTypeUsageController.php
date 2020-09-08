<?php

namespace App\Controller;

use App\Entity\CtTypeUsage;
use App\Form\CtTypeUsageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/type/usage")
 */
class CtTypeUsageController extends AbstractController
{
    /**
     * @Route("/", name="ct_type_usage_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctTypeUsages = $this->getDoctrine()
            ->getRepository(CtTypeUsage::class)
            ->findAll();

        return $this->render('ct_type_usage/index.html.twig', [
            'ct_type_usages' => $ctTypeUsages,
        ]);
    }

    /**
     * @Route("/new", name="ct_type_usage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctTypeUsage = new CtTypeUsage();
        $form = $this->createForm(CtTypeUsageType::class, $ctTypeUsage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctTypeUsage);
            $entityManager->flush();

            return $this->redirectToRoute('ct_type_usage_index');
        }

        return $this->render('ct_type_usage/new.html.twig', [
            'ct_type_usage' => $ctTypeUsage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_usage_show", methods={"GET"})
     */
    public function show(CtTypeUsage $ctTypeUsage): Response
    {
        return $this->render('ct_type_usage/show.html.twig', [
            'ct_type_usage' => $ctTypeUsage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_type_usage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtTypeUsage $ctTypeUsage): Response
    {
        $form = $this->createForm(CtTypeUsageType::class, $ctTypeUsage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_type_usage_index');
        }

        return $this->render('ct_type_usage/edit.html.twig', [
            'ct_type_usage' => $ctTypeUsage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_usage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtTypeUsage $ctTypeUsage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTypeUsage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctTypeUsage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_type_usage_index');
    }
}
