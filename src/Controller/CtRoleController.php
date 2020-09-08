<?php

namespace App\Controller;

use App\Entity\CtRole;
use App\Form\CtRoleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/role")
 */
class CtRoleController extends AbstractController
{
    /**
     * @Route("/", name="ct_role_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctRoles = $this->getDoctrine()
            ->getRepository(CtRole::class)
            ->findAll();

        return $this->render('ct_role/index.html.twig', [
            'ct_roles' => $ctRoles,
        ]);
    }

    /**
     * @Route("/new", name="ct_role_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctRole = new CtRole();
        $form = $this->createForm(CtRoleType::class, $ctRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctRole);
            $entityManager->flush();

            return $this->redirectToRoute('ct_role_index');
        }

        return $this->render('ct_role/new.html.twig', [
            'ct_role' => $ctRole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_role_show", methods={"GET"})
     */
    public function show(CtRole $ctRole): Response
    {
        return $this->render('ct_role/show.html.twig', [
            'ct_role' => $ctRole,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_role_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtRole $ctRole): Response
    {
        $form = $this->createForm(CtRoleType::class, $ctRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_role_index');
        }

        return $this->render('ct_role/edit.html.twig', [
            'ct_role' => $ctRole,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_role_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtRole $ctRole): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctRole->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctRole);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_role_index');
    }
}
