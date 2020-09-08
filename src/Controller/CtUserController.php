<?php

namespace App\Controller;

use App\Entity\CtUser;
use App\Form\CtUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/user")
 */
class CtUserController extends AbstractController
{
    /**
     * @Route("/", name="ct_user_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctUsers = $this->getDoctrine()
            ->getRepository(CtUser::class)
            ->findAll();

        return $this->render('ct_user/index.html.twig', [
            'ct_users' => $ctUsers,
        ]);
    }

    /**
     * @Route("/new", name="ct_user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctUser = new CtUser();
        $form = $this->createForm(CtUserType::class, $ctUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctUser);
            $entityManager->flush();

            return $this->redirectToRoute('ct_user_index');
        }

        return $this->render('ct_user/new.html.twig', [
            'ct_user' => $ctUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_user_show", methods={"GET"})
     */
    public function show(CtUser $ctUser): Response
    {
        return $this->render('ct_user/show.html.twig', [
            'ct_user' => $ctUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtUser $ctUser): Response
    {
        $form = $this->createForm(CtUserType::class, $ctUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_user_index');
        }

        return $this->render('ct_user/edit.html.twig', [
            'ct_user' => $ctUser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtUser $ctUser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctUser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_user_index');
    }
}
