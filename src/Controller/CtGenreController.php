<?php

namespace App\Controller;

use App\Entity\CtGenre;
use App\Form\CtGenreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/genre")
 */
class CtGenreController extends AbstractController
{
    /**
     * @Route("/", name="ct_genre_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctGenres = $this->getDoctrine()
            ->getRepository(CtGenre::class)
            ->findAll();

        return $this->render('ct_genre/index.html.twig', [
            'ct_genres' => $ctGenres,
        ]);
    }

    /**
     * @Route("/new", name="ct_genre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctGenre = new CtGenre();
        $form = $this->createForm(CtGenreType::class, $ctGenre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctGenre);
            $entityManager->flush();

            return $this->redirectToRoute('ct_genre_index');
        }

        return $this->render('ct_genre/new.html.twig', [
            'ct_genre' => $ctGenre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_genre_show", methods={"GET"})
     */
    public function show(CtGenre $ctGenre): Response
    {
        return $this->render('ct_genre/show.html.twig', [
            'ct_genre' => $ctGenre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_genre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtGenre $ctGenre): Response
    {
        $form = $this->createForm(CtGenreType::class, $ctGenre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_genre_index');
        }

        return $this->render('ct_genre/edit.html.twig', [
            'ct_genre' => $ctGenre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_genre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtGenre $ctGenre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctGenre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctGenre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_genre_index');
    }
}
