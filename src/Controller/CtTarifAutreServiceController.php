<?php

namespace App\Controller;

use App\Entity\CtTarifAutreService;
use App\Form\CtTarifAutreServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/tarif/autre/service")
 */
class CtTarifAutreServiceController extends AbstractController
{
    /**
     * @Route("/", name="ct_tarif_autre_service_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctTarifAutreServices = $this->getDoctrine()
            ->getRepository(CtTarifAutreService::class)
            ->findAll();

        return $this->render('ct_tarif_autre_service/index.html.twig', [
            'ct_tarif_autre_services' => $ctTarifAutreServices,
        ]);
    }

    /**
     * @Route("/new", name="ct_tarif_autre_service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctTarifAutreService = new CtTarifAutreService();
        $form = $this->createForm(CtTarifAutreServiceType::class, $ctTarifAutreService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctTarifAutreService);
            $entityManager->flush();

            return $this->redirectToRoute('ct_tarif_autre_service_index');
        }

        return $this->render('ct_tarif_autre_service/new.html.twig', [
            'ct_tarif_autre_service' => $ctTarifAutreService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_tarif_autre_service_show", methods={"GET"})
     */
    public function show(CtTarifAutreService $ctTarifAutreService): Response
    {
        return $this->render('ct_tarif_autre_service/show.html.twig', [
            'ct_tarif_autre_service' => $ctTarifAutreService,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_tarif_autre_service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtTarifAutreService $ctTarifAutreService): Response
    {
        $form = $this->createForm(CtTarifAutreServiceType::class, $ctTarifAutreService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_tarif_autre_service_index');
        }

        return $this->render('ct_tarif_autre_service/edit.html.twig', [
            'ct_tarif_autre_service' => $ctTarifAutreService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_tarif_autre_service_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtTarifAutreService $ctTarifAutreService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTarifAutreService->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctTarifAutreService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_tarif_autre_service_index');
    }
}
