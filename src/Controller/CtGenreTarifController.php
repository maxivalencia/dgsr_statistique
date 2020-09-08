<?php

namespace App\Controller;

use App\Entity\CtGenreTarif;
use App\Form\CtGenreTarifType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/genretarif")
 */
class CtGenreTarifController extends AbstractController
{
    /**
     * @Route("/", name="ct_genre_tarif_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctGenreTarifs = $this->getDoctrine()
            ->getRepository(CtGenreTarif::class)
            ->findAll();

        return $this->render('ct_genre_tarif/index.html.twig', [
            'ct_genre_tarifs' => $ctGenreTarifs,
        ]);
    }

    /**
     * @Route("/new", name="ct_genre_tarif_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctGenreTarif = new CtGenreTarif();
        $form = $this->createForm(CtGenreTarifType::class, $ctGenreTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctGenreTarif);
            $entityManager->flush();

            return $this->redirectToRoute('ct_genre_tarif_index');
        }

        return $this->render('ct_genre_tarif/new.html.twig', [
            'ct_genre_tarif' => $ctGenreTarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_genre_tarif_show", methods={"GET"})
     */
    public function show(CtGenreTarif $ctGenreTarif): Response
    {
        return $this->render('ct_genre_tarif/show.html.twig', [
            'ct_genre_tarif' => $ctGenreTarif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_genre_tarif_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtGenreTarif $ctGenreTarif): Response
    {
        $form = $this->createForm(CtGenreTarifType::class, $ctGenreTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_genre_tarif_index');
        }

        return $this->render('ct_genre_tarif/edit.html.twig', [
            'ct_genre_tarif' => $ctGenreTarif,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_genre_tarif_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtGenreTarif $ctGenreTarif): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctGenreTarif->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctGenreTarif);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_genre_tarif_index');
    }
}
