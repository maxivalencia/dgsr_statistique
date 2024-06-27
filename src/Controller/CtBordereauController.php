<?php

namespace App\Controller;

use App\Entity\CtBordereau;
use App\Form\CtBordereauType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/bordereau")
 */
class CtBordereauController extends AbstractController
{
    /**
     * @Route("/", name="ct_bordereau_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctBordereaus = $this->getDoctrine()
            ->getRepository(CtBordereau::class)
            ->findAll();

        return $this->render('ct_bordereau/index.html.twig', [
            'ct_bordereaus' => $ctBordereaus,
        ]);
    }

    /**
     * @Route("/new", name="ct_bordereau_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctBordereau = new CtBordereau();
        $form = $this->createForm(CtBordereauType::class, $ctBordereau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctBordereau);
            $entityManager->flush();

            return $this->redirectToRoute('ct_bordereau_index');
        }

        return $this->render('ct_bordereau/new.html.twig', [
            'ct_bordereau' => $ctBordereau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_bordereau_show", methods={"GET"})
     */
    public function show(CtBordereau $ctBordereau): Response
    {
        return $this->render('ct_bordereau/show.html.twig', [
            'ct_bordereau' => $ctBordereau,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_bordereau_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtBordereau $ctBordereau): Response
    {
        $form = $this->createForm(CtBordereauType::class, $ctBordereau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_bordereau_index');
        }

        return $this->render('ct_bordereau/edit.html.twig', [
            'ct_bordereau' => $ctBordereau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_bordereau_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtBordereau $ctBordereau): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctBordereau->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctBordereau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_bordereau_index');
    }
}
