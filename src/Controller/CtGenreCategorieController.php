<?php

namespace App\Controller;

use App\Entity\CtGenreCategorie;
use App\Form\CtGenreCategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/genrecategorie")
 */
class CtGenreCategorieController extends AbstractController
{
    /**
     * @Route("/", name="ct_genre_categorie_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctGenreCategories = $this->getDoctrine()
            ->getRepository(CtGenreCategorie::class)
            ->findAll();

        return $this->render('ct_genre_categorie/index.html.twig', [
            'ct_genre_categories' => $ctGenreCategories,
        ]);
    }

    /**
     * @Route("/new", name="ct_genre_categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctGenreCategorie = new CtGenreCategorie();
        $form = $this->createForm(CtGenreCategorieType::class, $ctGenreCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctGenreCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('ct_genre_categorie_index');
        }

        return $this->render('ct_genre_categorie/new.html.twig', [
            'ct_genre_categorie' => $ctGenreCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_genre_categorie_show", methods={"GET"})
     */
    public function show(CtGenreCategorie $ctGenreCategorie): Response
    {
        return $this->render('ct_genre_categorie/show.html.twig', [
            'ct_genre_categorie' => $ctGenreCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_genre_categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtGenreCategorie $ctGenreCategorie): Response
    {
        $form = $this->createForm(CtGenreCategorieType::class, $ctGenreCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_genre_categorie_index');
        }

        return $this->render('ct_genre_categorie/edit.html.twig', [
            'ct_genre_categorie' => $ctGenreCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_genre_categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtGenreCategorie $ctGenreCategorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctGenreCategorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctGenreCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_genre_categorie_index');
    }
}
