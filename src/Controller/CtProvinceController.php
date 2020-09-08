<?php

namespace App\Controller;

use App\Entity\CtProvince;
use App\Form\CtProvinceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/province")
 */
class CtProvinceController extends AbstractController
{
    /**
     * @Route("/", name="ct_province_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctProvinces = $this->getDoctrine()
            ->getRepository(CtProvince::class)
            ->findAll();

        return $this->render('ct_province/index.html.twig', [
            'ct_provinces' => $ctProvinces,
        ]);
    }

    /**
     * @Route("/new", name="ct_province_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctProvince = new CtProvince();
        $form = $this->createForm(CtProvinceType::class, $ctProvince);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctProvince);
            $entityManager->flush();

            return $this->redirectToRoute('ct_province_index');
        }

        return $this->render('ct_province/new.html.twig', [
            'ct_province' => $ctProvince,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_province_show", methods={"GET"})
     */
    public function show(CtProvince $ctProvince): Response
    {
        return $this->render('ct_province/show.html.twig', [
            'ct_province' => $ctProvince,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_province_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtProvince $ctProvince): Response
    {
        $form = $this->createForm(CtProvinceType::class, $ctProvince);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_province_index');
        }

        return $this->render('ct_province/edit.html.twig', [
            'ct_province' => $ctProvince,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_province_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtProvince $ctProvince): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctProvince->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctProvince);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_province_index');
    }
}
