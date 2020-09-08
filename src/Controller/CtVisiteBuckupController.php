<?php

namespace App\Controller;

use App\Entity\CtVisiteBuckup;
use App\Form\CtVisiteBuckupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/visite/buckup")
 */
class CtVisiteBuckupController extends AbstractController
{
    /**
     * @Route("/", name="ct_visite_buckup_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctVisiteBuckups = $this->getDoctrine()
            ->getRepository(CtVisiteBuckup::class)
            ->findAll();

        return $this->render('ct_visite_buckup/index.html.twig', [
            'ct_visite_buckups' => $ctVisiteBuckups,
        ]);
    }

    /**
     * @Route("/new", name="ct_visite_buckup_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctVisiteBuckup = new CtVisiteBuckup();
        $form = $this->createForm(CtVisiteBuckupType::class, $ctVisiteBuckup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctVisiteBuckup);
            $entityManager->flush();

            return $this->redirectToRoute('ct_visite_buckup_index');
        }

        return $this->render('ct_visite_buckup/new.html.twig', [
            'ct_visite_buckup' => $ctVisiteBuckup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_buckup_show", methods={"GET"})
     */
    public function show(CtVisiteBuckup $ctVisiteBuckup): Response
    {
        return $this->render('ct_visite_buckup/show.html.twig', [
            'ct_visite_buckup' => $ctVisiteBuckup,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_visite_buckup_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtVisiteBuckup $ctVisiteBuckup): Response
    {
        $form = $this->createForm(CtVisiteBuckupType::class, $ctVisiteBuckup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_visite_buckup_index');
        }

        return $this->render('ct_visite_buckup/edit.html.twig', [
            'ct_visite_buckup' => $ctVisiteBuckup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_visite_buckup_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtVisiteBuckup $ctVisiteBuckup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctVisiteBuckup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctVisiteBuckup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_visite_buckup_index');
    }
}
