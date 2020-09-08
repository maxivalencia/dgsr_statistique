<?php

namespace App\Controller;

use App\Entity\CtVisiteExtra;
use App\Form\CtVisiteExtraType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/visiteextra")
 */
class CtVisiteExtraController extends AbstractController
{
    /**
     * @Route("/", name="ct_visite_extra_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctVisiteExtras = $this->getDoctrine()
            ->getRepository(CtVisiteExtra::class)
            ->findAll();

        return $this->render('ct_visite_extra/index.html.twig', [
            'ct_visite_extras' => $ctVisiteExtras,
        ]);
    }

    /**
     * @Route("/new", name="ct_visite_extra_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctVisiteExtra = new CtVisiteExtra();
        $form = $this->createForm(CtVisiteExtraType::class, $ctVisiteExtra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctVisiteExtra);
            $entityManager->flush();

            return $this->redirectToRoute('ct_visite_extra_index');
        }

        return $this->render('ct_visite_extra/new.html.twig', [
            'ct_visite_extra' => $ctVisiteExtra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_extra_show", methods={"GET"})
     */
    public function show(CtVisiteExtra $ctVisiteExtra): Response
    {
        return $this->render('ct_visite_extra/show.html.twig', [
            'ct_visite_extra' => $ctVisiteExtra,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_visite_extra_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtVisiteExtra $ctVisiteExtra): Response
    {
        $form = $this->createForm(CtVisiteExtraType::class, $ctVisiteExtra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_visite_extra_index');
        }

        return $this->render('ct_visite_extra/edit.html.twig', [
            'ct_visite_extra' => $ctVisiteExtra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_extra_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtVisiteExtra $ctVisiteExtra): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctVisiteExtra->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctVisiteExtra);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_visite_extra_index');
    }
}
