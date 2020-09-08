<?php

namespace App\Controller;

use App\Entity\CtCarteGrise;
use App\Form\CtCarteGriseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Collection;

// Include paginator interface
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/ct/carte/grise")
 */
class CtCarteGriseController extends AbstractController
{
    /**
     * @Route("/", name="ct_carte_grise_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $ctCarteGrises = $this->getDoctrine()
            ->getRepository(CtCarteGrise::class)
            ->findAll();

        $ctCarteGrisesPaginer = $paginator->paginate(
            $ctCarteGrises,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            20
        );

        return $this->render('ct_carte_grise/index.html.twig', [
            'ct_carte_grises' => $ctCarteGrisesPaginer,
        ]);
    }

    /**
     * @Route("/new", name="ct_carte_grise_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctCarteGrise = new CtCarteGrise();
        $form = $this->createForm(CtCarteGriseType::class, $ctCarteGrise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctCarteGrise);
            $entityManager->flush();

            return $this->redirectToRoute('ct_carte_grise_index');
        }

        return $this->render('ct_carte_grise/new.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_carte_grise_show", methods={"GET"})
     */
    public function show(CtCarteGrise $ctCarteGrise): Response
    {
        return $this->render('ct_carte_grise/show.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_carte_grise_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtCarteGrise $ctCarteGrise): Response
    {
        $form = $this->createForm(CtCarteGriseType::class, $ctCarteGrise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_carte_grise_index');
        }

        return $this->render('ct_carte_grise/edit.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_carte_grise_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtCarteGrise $ctCarteGrise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctCarteGrise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctCarteGrise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_carte_grise_index');
    }
}
