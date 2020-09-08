<?php

namespace App\Controller;

use App\Entity\CtDroitPtacBackup;
use App\Form\CtDroitPtacBackupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/droit/ptacbackup")
 */
class CtDroitPtacBackupController extends AbstractController
{
    /**
     * @Route("/", name="ct_droit_ptac_backup_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ctDroitPtacBackups = $this->getDoctrine()
            ->getRepository(CtDroitPtacBackup::class)
            ->findAll();

        return $this->render('ct_droit_ptac_backup/index.html.twig', [
            'ct_droit_ptac_backups' => $ctDroitPtacBackups,
        ]);
    }

    /**
     * @Route("/new", name="ct_droit_ptac_backup_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ctDroitPtacBackup = new CtDroitPtacBackup();
        $form = $this->createForm(CtDroitPtacBackupType::class, $ctDroitPtacBackup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ctDroitPtacBackup);
            $entityManager->flush();

            return $this->redirectToRoute('ct_droit_ptac_backup_index');
        }

        return $this->render('ct_droit_ptac_backup/new.html.twig', [
            'ct_droit_ptac_backup' => $ctDroitPtacBackup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_droit_ptac_backup_show", methods={"GET"})
     */
    public function show(CtDroitPtacBackup $ctDroitPtacBackup): Response
    {
        return $this->render('ct_droit_ptac_backup/show.html.twig', [
            'ct_droit_ptac_backup' => $ctDroitPtacBackup,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_droit_ptac_backup_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CtDroitPtacBackup $ctDroitPtacBackup): Response
    {
        $form = $this->createForm(CtDroitPtacBackupType::class, $ctDroitPtacBackup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ct_droit_ptac_backup_index');
        }

        return $this->render('ct_droit_ptac_backup/edit.html.twig', [
            'ct_droit_ptac_backup' => $ctDroitPtacBackup,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ct_droit_ptac_backup_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CtDroitPtacBackup $ctDroitPtacBackup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctDroitPtacBackup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ctDroitPtacBackup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ct_droit_ptac_backup_index');
    }
}
