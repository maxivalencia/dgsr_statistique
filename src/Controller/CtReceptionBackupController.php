<?php

namespace App\Controller;

use App\Entity\CtReceptionBackup;
use App\Form\CtReceptionBackupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/receptionbackup")
 */
class CtReceptionBackupController extends AbstractController
{
    /**
     * @Route("/", name="ct_reception_backup_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctReceptionBackups = $this->getDoctrine()
            ->getRepository(CtReceptionBackup::class)
            ->findAll();

        return $this->render('ct_reception_backup/index.html.twig', [
            'ct_reception_backups' => $ctReceptionBackups,
        ]);
    }

    /**
     * @Route("/new", name="ct_reception_backup_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctReceptionBackup = new CtReceptionBackup();
        $form = $this->createForm(CtReceptionBackupType::class, $ctReceptionBackup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctReceptionBackup);
            $entityManager->flush();

            return $this->redirectToRoute('ct_reception_backup_index');
        }

        return $this->render('ct_reception_backup/new.html.twig', [
            'ct_reception_backup' => $ctReceptionBackup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_reception_backup_show", methods={"GET"})
     */
    public function show(CtReceptionBackup $ctReceptionBackup): Response
    {
        return $this->render('ct_reception_backup/show.html.twig', [
            'ct_reception_backup' => $ctReceptionBackup,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_reception_backup_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtReceptionBackup $ctReceptionBackup): Response
    {
        $form = $this->createForm(CtReceptionBackupType::class, $ctReceptionBackup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_reception_backup_index');
        }

        return $this->render('ct_reception_backup/edit.html.twig', [
            'ct_reception_backup' => $ctReceptionBackup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_reception_backup_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtReceptionBackup $ctReceptionBackup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctReceptionBackup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctReceptionBackup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_reception_backup_index');
    }
}
