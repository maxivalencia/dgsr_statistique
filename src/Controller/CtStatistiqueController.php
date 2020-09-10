<?php

namespace App\Controller;

use App\Entity\CtVisite;
use App\Entity\CtVehicule;
use App\Entity\CtCarteGrise;
use App\Entity\CtReception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CtStatistiqueController extends AbstractController
{
    /**
     * @Route("/ct/statistique", name="ct_statistique", methods={"GET","POST"})
     */
    public function statistique(Request $request): Response
    {
        $numero = $request->query->get('numero');
        if($numero == ''){
            return $this->render('ct_statistique/recherche.html.twig');
        }
        $cg_vehicule = new CtCarteGrise();
        $vehicule_identification = new CtVehicule();
        // Récupération des informations de la carte grise
        $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['cgImmatriculation' => $numero]);
        $cg_vehicule = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['id' => $ctCarteGrise]);
        $ns_vehicule = $cg_vehicule->getCtVehicule();
        $vehicule_identification = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['id' => $ns_vehicule]);

        // Récupération des visites
        $visites = $this->getDoctrine()->getRepository(CtVisite::class)->findBy(['ctCarteGrise' => $cg_vehicule->getId()]);

        // Récupération des réceptions
        $reception = $this->getDoctrine()->getRepository(CtReception::class)->findBy(['ctVehicule' => $vehicule_identification]);

        // Rendu pou affichage des informations obtenue
        return $this->render('ct_statistique/index.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
            'numero_de_serie' => $ns_vehicule,
            'vehicule_identification' => $vehicule_identification,
            'visites' => $visites,
            'receptions' => $reception,
        ]);
    }

    /**
     * @Route("/ct/recherche", name="ct_recherche", methods={"GET", "POST"})
     */
    public function recherche(): Response
    {
        return $this->render('ct_statistique/recherche.html.twig');
    }
}
