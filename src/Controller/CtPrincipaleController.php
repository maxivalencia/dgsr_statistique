<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CtPrincipaleController extends AbstractController
{
    /**
     * @Route("/principale", name="ct_principale")
     */
    public function index()
    {
        return $this->redirectToRoute('ct_statistique');
    }
}
