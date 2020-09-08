<?php

namespace App\Controller;

use App\Entity\CtVisite;
use App\Form\CtVisiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/visite")
 */
class CtVisiteController extends AbstractController
{
    /**
     * @Route("/", name="ct_visite_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctVisites = $this->getDoctrine()
            ->getRepository(CtVisite::class)
            ->findAll();

        return $this->render('ct_visite/index.html.twig', [
            'ct_visites' => $ctVisites,
        ]);
    }

    /**
     * @Route("/new", name="ct_visite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctVisite = new CtVisite();
        $form = $this->createForm(CtVisiteType::class, $ctVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctVisite);
            $entityManager->flush();

            return $this->redirectToRoute('ct_visite_index');
        }

        return $this->render('ct_visite/new.html.twig', [
            'ct_visite' => $ctVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_show", methods={"GET"})
     */
    public function show(CtVisite $ctVisite): Response
    {
        return $this->render('ct_visite/show.html.twig', [
            'ct_visite' => $ctVisite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtVisite $ctVisite): Response
    {
        $form = $this->createForm(CtVisiteType::class, $ctVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_visite_index');
        }

        return $this->render('ct_visite/edit.html.twig', [
            'ct_visite' => $ctVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtVisite $ctVisite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctVisite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctVisite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_visite_index');
    }
}
