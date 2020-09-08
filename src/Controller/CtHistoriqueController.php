<?php

namespace App\Controller;

use App\Entity\CtHistorique;
use App\Form\CtHistoriqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/historique")
 */
class CtHistoriqueController extends AbstractController
{
    /**
     * @Route("/", name="ct_historique_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctHistoriques = $this->getDoctrine()
            ->getRepository(CtHistorique::class)
            ->findAll();

        return $this->render('ct_historique/index.html.twig', [
            'ct_historiques' => $ctHistoriques,
        ]);
    }

    /**
     * @Route("/new", name="ct_historique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctHistorique = new CtHistorique();
        $form = $this->createForm(CtHistoriqueType::class, $ctHistorique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctHistorique);
            $entityManager->flush();

            return $this->redirectToRoute('ct_historique_index');
        }

        return $this->render('ct_historique/new.html.twig', [
            'ct_historique' => $ctHistorique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_historique_show", methods={"GET"})
     */
    public function show(CtHistorique $ctHistorique): Response
    {
        return $this->render('ct_historique/show.html.twig', [
            'ct_historique' => $ctHistorique,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_historique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtHistorique $ctHistorique): Response
    {
        $form = $this->createForm(CtHistoriqueType::class, $ctHistorique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_historique_index');
        }

        return $this->render('ct_historique/edit.html.twig', [
            'ct_historique' => $ctHistorique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_historique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtHistorique $ctHistorique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctHistorique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctHistorique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_historique_index');
    }
}
