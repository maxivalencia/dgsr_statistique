<?php

namespace App\Controller;

use App\Entity\CtConstAvDed;
use App\Form\CtConstAvDedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/const/av/ded")
 */
class CtConstAvDedController extends AbstractController
{
    /**
     * @Route("/", name="ct_const_av_ded_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctConstAvDeds = $this->getDoctrine()
            ->getRepository(CtConstAvDed::class)
            ->findAll();

        return $this->render('ct_const_av_ded/index.html.twig', [
            'ct_const_av_deds' => $ctConstAvDeds,
        ]);
    }

    /**
     * @Route("/new", name="ct_const_av_ded_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctConstAvDed = new CtConstAvDed();
        $form = $this->createForm(CtConstAvDedType::class, $ctConstAvDed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctConstAvDed);
            $entityManager->flush();

            return $this->redirectToRoute('ct_const_av_ded_index');
        }

        return $this->render('ct_const_av_ded/new.html.twig', [
            'ct_const_av_ded' => $ctConstAvDed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_const_av_ded_show", methods={"GET"})
     */
    public function show(CtConstAvDed $ctConstAvDed): Response
    {
        return $this->render('ct_const_av_ded/show.html.twig', [
            'ct_const_av_ded' => $ctConstAvDed,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_const_av_ded_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtConstAvDed $ctConstAvDed): Response
    {
        $form = $this->createForm(CtConstAvDedType::class, $ctConstAvDed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_const_av_ded_index');
        }

        return $this->render('ct_const_av_ded/edit.html.twig', [
            'ct_const_av_ded' => $ctConstAvDed,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_const_av_ded_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtConstAvDed $ctConstAvDed): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctConstAvDed->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctConstAvDed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_const_av_ded_index');
    }
}
