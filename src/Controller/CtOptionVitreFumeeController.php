<?php

namespace App\Controller;

use App\Entity\CtOptionVitreFumee;
use App\Form\CtOptionVitreFumeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/option/vitre/fumee")
 */
class CtOptionVitreFumeeController extends AbstractController
{
    /**
     * @Route("/", name="ct_option_vitre_fumee_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctOptionVitreFumees = $this->getDoctrine()
            ->getRepository(CtOptionVitreFumee::class)
            ->findAll();

        return $this->render('ct_option_vitre_fumee/index.html.twig', [
            'ct_option_vitre_fumees' => $ctOptionVitreFumees,
        ]);
    }

    /**
     * @Route("/new", name="ct_option_vitre_fumee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctOptionVitreFumee = new CtOptionVitreFumee();
        $form = $this->createForm(CtOptionVitreFumeeType::class, $ctOptionVitreFumee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctOptionVitreFumee);
            $entityManager->flush();

            return $this->redirectToRoute('ct_option_vitre_fumee_index');
        }

        return $this->render('ct_option_vitre_fumee/new.html.twig', [
            'ct_option_vitre_fumee' => $ctOptionVitreFumee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_option_vitre_fumee_show", methods={"GET"})
     */
    public function show(CtOptionVitreFumee $ctOptionVitreFumee): Response
    {
        return $this->render('ct_option_vitre_fumee/show.html.twig', [
            'ct_option_vitre_fumee' => $ctOptionVitreFumee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_option_vitre_fumee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtOptionVitreFumee $ctOptionVitreFumee): Response
    {
        $form = $this->createForm(CtOptionVitreFumeeType::class, $ctOptionVitreFumee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_option_vitre_fumee_index');
        }

        return $this->render('ct_option_vitre_fumee/edit.html.twig', [
            'ct_option_vitre_fumee' => $ctOptionVitreFumee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_option_vitre_fumee_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtOptionVitreFumee $ctOptionVitreFumee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctOptionVitreFumee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctOptionVitreFumee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_option_vitre_fumee_index');
    }
}
