<?php

namespace App\Controller;

use App\Entity\CtImprimeTechUse;
use App\Form\CtImprimeTechUseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/imprime/tech/use")
 */
class CtImprimeTechUseController extends AbstractController
{
    /**
     * @Route("/", name="ct_imprime_tech_use_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctImprimeTechUses = $this->getDoctrine()
            ->getRepository(CtImprimeTechUse::class)
            ->findAll();

        return $this->render('ct_imprime_tech_use/index.html.twig', [
            'ct_imprime_tech_uses' => $ctImprimeTechUses,
        ]);
    }

    /**
     * @Route("/new", name="ct_imprime_tech_use_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctImprimeTechUse = new CtImprimeTechUse();
        $form = $this->createForm(CtImprimeTechUseType::class, $ctImprimeTechUse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctImprimeTechUse);
            $entityManager->flush();

            return $this->redirectToRoute('ct_imprime_tech_use_index');
        }

        return $this->render('ct_imprime_tech_use/new.html.twig', [
            'ct_imprime_tech_use' => $ctImprimeTechUse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_imprime_tech_use_show", methods={"GET"})
     */
    public function show(CtImprimeTechUse $ctImprimeTechUse): Response
    {
        return $this->render('ct_imprime_tech_use/show.html.twig', [
            'ct_imprime_tech_use' => $ctImprimeTechUse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_imprime_tech_use_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtImprimeTechUse $ctImprimeTechUse): Response
    {
        $form = $this->createForm(CtImprimeTechUseType::class, $ctImprimeTechUse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_imprime_tech_use_index');
        }

        return $this->render('ct_imprime_tech_use/edit.html.twig', [
            'ct_imprime_tech_use' => $ctImprimeTechUse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_imprime_tech_use_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtImprimeTechUse $ctImprimeTechUse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctImprimeTechUse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctImprimeTechUse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_imprime_tech_use_index');
    }
}
