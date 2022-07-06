<?php

namespace App\Controller;

use App\Entity\CtUser;
use App\Entity\CtCentre;
use App\Form\CtAffectationType;
use App\Repository\CtUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;

class CtAffectationController extends AbstractController
{
    /**
     * @Route("/ct/affectation/liste", name="ct_liste")
     */
    public function liste(Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $ctUsers = $this->getDoctrine()->getRepository(CtUser::class)->findAll(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );
        //$ctUsers = $this->getDoctrine()->getRepository(CtUser::class)->findAll();

        return $this->render('ct_affectation/liste.html.twig', [
            'controller_name' => 'Ct Affectation liste',
            'ct_users' => $pagination,
        ]);
    }

    /**
     * @Route("/ct/affectation/{id}", name="ct_affectation", methods={"GET","POST"})
     */
    public function affectation(Request $request, CtUser $ctUser): Response
    {
        $form = $this->createForm(CtAffectationType::class, $ctUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $ctUsers = $this->getDoctrine()
                ->getRepository(CtUser::class)
                ->findBy(["id" => $ctUser->getId()]);
            return $this->render('ct_affectation/liste.html.twig', [
                'controller_name' => 'Ct Affectation liste',
                'ct_users' => $ctUsers,
            ]);

            //return $this->redirectToRoute('ct_liste');
        }

        return $this->render('ct_affectation/index.html.twig', [
            'controller_name' => 'Ct Affectation action',
            'ct_user' => $ctUser,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/recherche", name="user_recherche", methods={"GET"})
     */
    public function recherche(CtUserRepository $ctUserRepository/* , PhotosRepository $photosRepository */, Request $request/* , PaginatorInterface $paginator */): Response
    {
        //$pagination = $paginator->paginate(
        //    $personnelsRepository->rechercher($request->query->get('search')), /* query NOT result */
        //    $request->query->getInt('page', 1)/*page number*/,
        //    10/*limit per page*/
        //);      
        /* $ctUsers = $this->getDoctrine()
            ->getRepository(CtUser::class)
            ->rechercher(['username' => $request->query->get('search')]); */
        $ctUsers = $ctUserRepository->rechercher($request->query->get('search'));
        return $this->render('ct_affectation/liste.html.twig', [
            'controller_name' => 'Ct Affectation liste',
            'ct_users' => $ctUsers,
        ]);
    }
}
