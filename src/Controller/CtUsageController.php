<?php

namespace App\Controller;

use App\Entity\CtUsage;
use App\Form\CtUsageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/usage")
 */
class CtUsageController extends AbstractController
{
    /**
     * @Route("/", name="ct_usage_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctUsages = $this->getDoctrine()
            ->getRepository(CtUsage::class)
            ->findAll();

        return $this->render('ct_usage/index.html.twig', [
            'ct_usages' => $ctUsages,
        ]);
    }

    /**
     * @Route("/new", name="ct_usage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctUsage = new CtUsage();
        $form = $this->createForm(CtUsageType::class, $ctUsage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctUsage);
            $entityManager->flush();

            return $this->redirectToRoute('ct_usage_index');
        }

        return $this->render('ct_usage/new.html.twig', [
            'ct_usage' => $ctUsage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_usage_show", methods={"GET"})
     */
    public function show(CtUsage $ctUsage): Response
    {
        return $this->render('ct_usage/show.html.twig', [
            'ct_usage' => $ctUsage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_usage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtUsage $ctUsage): Response
    {
        $form = $this->createForm(CtUsageType::class, $ctUsage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_usage_index');
        }

        return $this->render('ct_usage/edit.html.twig', [
            'ct_usage' => $ctUsage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_usage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtUsage $ctUsage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctUsage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctUsage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_usage_index');
    }
}
