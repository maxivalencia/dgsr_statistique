<?php

namespace App\Controller;

use App\Entity\CtCarosserie;
use App\Form\CtCarosserieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/carosserie")
 */
class CtCarosserieController extends AbstractController
{
    /**
     * @Route("/", name="ct_carosserie_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctCarosseries = $this->getDoctrine()
            ->getRepository(CtCarosserie::class)
            ->findAll();

        return $this->render('ct_carosserie/index.html.twig', [
            'ct_carosseries' => $ctCarosseries,
        ]);
    }

    /**
     * @Route("/new", name="ct_carosserie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctCarosserie = new CtCarosserie();
        $form = $this->createForm(CtCarosserieType::class, $ctCarosserie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctCarosserie);
            $entityManager->flush();

            return $this->redirectToRoute('ct_carosserie_index');
        }

        return $this->render('ct_carosserie/new.html.twig', [
            'ct_carosserie' => $ctCarosserie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_carosserie_show", methods={"GET"})
     */
    public function show(CtCarosserie $ctCarosserie): Response
    {
        return $this->render('ct_carosserie/show.html.twig', [
            'ct_carosserie' => $ctCarosserie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_carosserie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtCarosserie $ctCarosserie): Response
    {
        $form = $this->createForm(CtCarosserieType::class, $ctCarosserie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_carosserie_index');
        }

        return $this->render('ct_carosserie/edit.html.twig', [
            'ct_carosserie' => $ctCarosserie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_carosserie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtCarosserie $ctCarosserie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctCarosserie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctCarosserie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_carosserie_index');
    }
}
