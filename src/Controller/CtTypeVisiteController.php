<?php

namespace App\Controller;

use App\Entity\CtTypeVisite;
use App\Form\CtTypeVisiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/type/visite")
 */
class CtTypeVisiteController extends AbstractController
{
    /**
     * @Route("/", name="ct_type_visite_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctTypeVisites = $this->getDoctrine()
            ->getRepository(CtTypeVisite::class)
            ->findAll();

        return $this->render('ct_type_visite/index.html.twig', [
            'ct_type_visites' => $ctTypeVisites,
        ]);
    }

    /**
     * @Route("/new", name="ct_type_visite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctTypeVisite = new CtTypeVisite();
        $form = $this->createForm(CtTypeVisiteType::class, $ctTypeVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctTypeVisite);
            $entityManager->flush();

            return $this->redirectToRoute('ct_type_visite_index');
        }

        return $this->render('ct_type_visite/new.html.twig', [
            'ct_type_visite' => $ctTypeVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_visite_show", methods={"GET"})
     */
    public function show(CtTypeVisite $ctTypeVisite): Response
    {
        return $this->render('ct_type_visite/show.html.twig', [
            'ct_type_visite' => $ctTypeVisite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_type_visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtTypeVisite $ctTypeVisite): Response
    {
        $form = $this->createForm(CtTypeVisiteType::class, $ctTypeVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_type_visite_index');
        }

        return $this->render('ct_type_visite/edit.html.twig', [
            'ct_type_visite' => $ctTypeVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_type_visite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtTypeVisite $ctTypeVisite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTypeVisite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctTypeVisite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_type_visite_index');
    }
}
