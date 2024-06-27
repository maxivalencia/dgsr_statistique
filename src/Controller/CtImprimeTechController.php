<?php

namespace App\Controller;

use App\Entity\CtImprimeTech;
use App\Form\CtImprimeTechType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/imprime/tech")
 */
class CtImprimeTechController extends AbstractController
{
    /**
     * @Route("/", name="ct_imprime_tech_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctImprimeTeches = $this->getDoctrine()
            ->getRepository(CtImprimeTech::class)
            ->findAll();

        return $this->render('ct_imprime_tech/index.html.twig', [
            'ct_imprime_teches' => $ctImprimeTeches,
        ]);
    }

    /**
     * @Route("/new", name="ct_imprime_tech_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctImprimeTech = new CtImprimeTech();
        $form = $this->createForm(CtImprimeTechType::class, $ctImprimeTech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctImprimeTech);
            $entityManager->flush();

            return $this->redirectToRoute('ct_imprime_tech_index');
        }

        return $this->render('ct_imprime_tech/new.html.twig', [
            'ct_imprime_tech' => $ctImprimeTech,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_imprime_tech_show", methods={"GET"})
     */
    public function show(CtImprimeTech $ctImprimeTech): Response
    {
        return $this->render('ct_imprime_tech/show.html.twig', [
            'ct_imprime_tech' => $ctImprimeTech,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_imprime_tech_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtImprimeTech $ctImprimeTech): Response
    {
        $form = $this->createForm(CtImprimeTechType::class, $ctImprimeTech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_imprime_tech_index');
        }

        return $this->render('ct_imprime_tech/edit.html.twig', [
            'ct_imprime_tech' => $ctImprimeTech,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_imprime_tech_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtImprimeTech $ctImprimeTech): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctImprimeTech->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctImprimeTech);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_imprime_tech_index');
    }
}
