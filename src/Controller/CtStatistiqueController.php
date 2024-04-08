<?php

namespace App\Controller;

use App\Entity\CtVisite;
use App\Entity\CtVehicule;
use App\Entity\CtReception;
use App\Entity\CtCarteGrise;
use App\Entity\CtConstAvDed;
use App\Entity\CtConstAvDedCarac;
use App\Entity\CtConstAvDedsConstAvDedCaracs;
use App\Form\CtConstAvDedCaracType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\VarDumper\VarDumper;

class CtStatistiqueController extends AbstractController
{
    /**
     * @Route("/ct/statistique", name="ct_statistique", methods={"GET","POST"})
     */
    public function statistique(Request $request): Response
    {
        $numero = strtoupper(trim($request->query->get('numero')));
        /* $numeros = explode(' ', $numero);
        $numero = "";
        foreach($numeros as $num){
            $numero .= strtoupper($num);
        } */

        if($numero == ''){
            return $this->render('ct_statistique/recherche.html.twig');
        }
        $ctCarteGrise = new CtCarteGrise();
        $cg_vehicule = new CtVehicule();
        $rcp_immatriculation = new CtReception();
        // Récupération des informations de la carte grise
        $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['cgImmatriculation' => $numero]);
        if ($ctCarteGrise != null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $ctCarteGrise->getCtVehicule()->getVhcNumSerie()]);
        }
        if ($cg_vehicule == null || $ctCarteGrise == null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $numero]);
            if ($cg_vehicule != null) {
                $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule->getId()]);
            }
        }
        if($cg_vehicule == null || $ctCarteGrise == null){
            $rcp_immatriculation = $this->getDoctrine()->getRepository(CtReception::class)->findOneBy(['rcpImmatriculation' => $numero]);
            if ($rcp_immatriculation != null) {
                $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $rcp_immatriculation->getCtVehicule()->getVhcNumSerie()]);
                if ($cg_vehicule != null) {
                    $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule->getId()]);
                }
            }
        }

        //$cg_vehicule = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['id' => $ctCarteGrise]);
        //if($cg_vehicule == null){
        //    return $this->render('ct_statistique/recherche.html.twig');
        //}
        $visites[] = new CtVisite();
        $receptions[] = new CtReception();
        $constatation[] = new CtConstAvDed();
        $constatation_caracteristique = new CtConstAvDedCarac();
        $constatations_caracteristiques[] = new CtConstAvDedCarac();
        $constatations_jointures = new CtConstAvDedsConstAvDedCaracs();
        if ($cg_vehicule != null) {
            //$ns_vehicule = $cg_vehicule;
            //$vehicule_identification = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['id' => $cg_vehicule]);

            // Récupération des visites
            if ($ctCarteGrise != null) {
                $visites = $this->getDoctrine()->getRepository(CtVisite::class)->findBy(['ctCarteGrise' => $ctCarteGrise->getId()], ['id' => 'DESC']);
            }
            // Récupération des réceptions
            if ($cg_vehicule != null) {
                $receptions = $this->getDoctrine()->getRepository(CtReception::class)->findBy(['ctVehicule' => $cg_vehicule->getId()], ['id' => 'DESC']);
            }
        }
        // Récupération des constatations avant dédouanement
        if ($cg_vehicule != null) {
            $constatations_caracteristiques = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findBy(['cadNumSerieType' => $cg_vehicule->getVhcNumSerie()]);
            $constatation_caracteristique = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['cadNumSerieType' => $cg_vehicule->getVhcNumSerie()], ['id' => 'DESC']);
            $constatations_jointures = $this->getDoctrine()->getRepository(CtConstAvDedsConstAvDedCaracs::class)->findOneBy(['const_av_ded_carac_id' => $constatation_caracteristique]);
            if ($constatations_jointures != null) {
                //$jointure = new CtConstAvDedsConstAvDedCaracs();
                //foreach ($jointure as $constatations_jointures) {
                    $constatation[] = $this->getDoctrine()->getRepository(CtConstAvDed::class)->findOneBy(['id' => $constatations_jointures->getConstAvDedId()]);
                //}
            }
        } else {
            $constatations_caracteristiques = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findBy(['cadNumSerieType' => $numero]);
            $constatation_caracteristique = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['cadNumSerieType' => $numero], ['id' => 'DESC']);
            $constatations_jointures = $this->getDoctrine()->getRepository(CtConstAvDedsConstAvDedCaracs::class)->findOneBy(['const_av_ded_carac_id' => $constatation_caracteristique]);
            if ($constatations_jointures != null) {
                //$jointure = new CtConstAvDedsConstAvDedCaracs();
                //foreach ($jointure as $constatations_jointures) {
                    $constatation[] = $this->getDoctrine()->getRepository(CtConstAvDed::class)->findOneBy(['id' => $constatations_jointures->getConstAvDedId()]);
                //}
            }
        }  
        if ($ctCarteGrise == null){
            $ctCarteGrise = new CtCarteGrise();
        }
        if ($rcp_immatriculation == null){
            $rcp_immatriculation = new CtReception();
        }
        if ($cg_vehicule == null){
            $cg_vehicule = new CtVehicule();
        }
        // Rendu pou affichage des informations obtenue
        return $this->render('ct_statistique/index.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
            'numero_de_serie' => $numero,
            'vehicule_identification' => $cg_vehicule,
            'visites' => $visites,
            'receptions' => $receptions,
            'ct_const_av_ded_caracs' => $constatations_caracteristiques,
            'ct_const_av_deds' => $constatation,
        ]);
    }

 
    /**
     * @Route("/ct/adm/statistique", name="ct_adm_statistique", methods={"GET","POST"})
     */
    public function admStatistique(Request $request): Response
    {
        $numero = strtoupper(trim($request->query->get('numero')));
        /* $numeros = explode(' ', $numero);
        $numero = "";
        foreach($numeros as $num){
            $numero .= strtoupper($num);
        } */

        if($numero == ''){
            return $this->render('ct_statistique/adm_recherche.html.twig');
        }
        $ctCarteGrise = new CtCarteGrise();
        $cg_vehicule = new CtVehicule();
        $rcp_immatriculation = new CtReception();
        // Récupération des informations de la carte grise
        $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['cgImmatriculation' => $numero]);
        if ($ctCarteGrise != null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $ctCarteGrise->getCtVehicule()->getVhcNumSerie()]);
        }
        if ($cg_vehicule == null || $ctCarteGrise == null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $numero]);
            if ($cg_vehicule != null) {
                $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule->getId()]);
            }
        }
        if($cg_vehicule == null || $ctCarteGrise == null){
            $rcp_immatriculation = $this->getDoctrine()->getRepository(CtReception::class)->findOneBy(['rcpImmatriculation' => $numero]);
            if ($rcp_immatriculation != null) {
                $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $rcp_immatriculation->getCtVehicule()->getVhcNumSerie()]);
                if ($cg_vehicule != null) {
                    $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule->getId()]);
                }
            }
        }

        //$cg_vehicule = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['id' => $ctCarteGrise]);
        //if($cg_vehicule == null){
        //    return $this->render('ct_statistique/recherche.html.twig');
        //}
        $visites[] = new CtVisite();
        $receptions[] = new CtReception();
        $constatation[] = new CtConstAvDed();
        $constatation_caracteristique = new CtConstAvDedCarac();
        $constatations_caracteristiques[] = new CtConstAvDedCarac();
        $constatations_jointures = new CtConstAvDedsConstAvDedCaracs();
        if ($cg_vehicule != null) {
            //$ns_vehicule = $cg_vehicule;
            //$vehicule_identification = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['id' => $cg_vehicule]);

            // Récupération des visites
            if ($ctCarteGrise != null) {
                $visites = $this->getDoctrine()->getRepository(CtVisite::class)->findBy(['ctCarteGrise' => $ctCarteGrise->getId()], ['id' => 'DESC']);
            }
            // Récupération des réceptions
            if ($cg_vehicule != null) {
                $receptions = $this->getDoctrine()->getRepository(CtReception::class)->findBy(['ctVehicule' => $cg_vehicule->getId()], ['id' => 'DESC']);
            }
        }
        // Récupération des constatations avant dédouanement
        if ($cg_vehicule != null) {
            $constatations_caracteristiques = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findBy(['cadNumSerieType' => $cg_vehicule->getVhcNumSerie()]);
            $constatation_caracteristique = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['cadNumSerieType' => $cg_vehicule->getVhcNumSerie()], ['id' => 'DESC']);
            $constatations_jointures = $this->getDoctrine()->getRepository(CtConstAvDedsConstAvDedCaracs::class)->findOneBy(['const_av_ded_carac_id' => $constatation_caracteristique]);
            if ($constatations_jointures != null) {
                //$jointure = new CtConstAvDedsConstAvDedCaracs();
                //foreach ($jointure as $constatations_jointures) {
                    $constatation[] = $this->getDoctrine()->getRepository(CtConstAvDed::class)->findOneBy(['id' => $constatations_jointures->getConstAvDedId()]);
                //}
            }
        } else {
            $constatations_caracteristiques = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findBy(['cadNumSerieType' => $numero]);
            $constatation_caracteristique = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['cadNumSerieType' => $numero], ['id' => 'DESC']);
            $constatations_jointures = $this->getDoctrine()->getRepository(CtConstAvDedsConstAvDedCaracs::class)->findOneBy(['const_av_ded_carac_id' => $constatation_caracteristique]);
            if ($constatations_jointures != null) {
                //$jointure = new CtConstAvDedsConstAvDedCaracs();
                //foreach ($jointure as $constatations_jointures) {
                    $constatation[] = $this->getDoctrine()->getRepository(CtConstAvDed::class)->findOneBy(['id' => $constatations_jointures->getConstAvDedId()]);
                //}
            }
        }  
        if ($ctCarteGrise == null){
            $ctCarteGrise = new CtCarteGrise();
        }
        if ($rcp_immatriculation == null){
            $rcp_immatriculation = new CtReception();
        }
        if ($cg_vehicule == null){
            $cg_vehicule = new CtVehicule();
        }
        // Rendu pou affichage des informations obtenue
        return $this->render('ct_statistique/adm_index.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
            'numero_de_serie' => $numero,
            'vehicule_identification' => $cg_vehicule,
            'visites' => $visites,
            'receptions' => $receptions,
            'ct_const_av_ded_caracs' => $constatations_caracteristiques,
            'ct_const_av_deds' => $constatation,
        ]);
    }

    /**
     * @Route("/ct/api", name="ct_statistique_api", methods={"GET", "POST"})
     */
    public function statistiqueAPI(Request $request)//: Response
    {
        $numero = strtoupper(trim($request->query->get('numero')));
        if($numero == ''){
            return $this->render('ct_statistique/recherche.html.twig');
        }
        $ctCarteGrise = new CtCarteGrise();
        $cg_vehicule = new CtVehicule();
        $rcp_immatriculation = new CtReception();
        // Récupération des informations de la carte grise
        $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['cgImmatriculation' => $numero]);
        if ($ctCarteGrise != null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $ctCarteGrise->getCtVehicule()->getVhcNumSerie()]);
        }
        if ($cg_vehicule == null || $ctCarteGrise == null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $numero]);
            if ($cg_vehicule != null) {
                $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule->getId()]);
            }
        }
        if($cg_vehicule == null || $ctCarteGrise == null){
            $rcp_immatriculation = $this->getDoctrine()->getRepository(CtReception::class)->findOneBy(['rcpImmatriculation' => $numero]);
            if ($rcp_immatriculation != null) {
                $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $rcp_immatriculation->getCtVehicule()->getVhcNumSerie()]);
                if ($cg_vehicule != null) {
                    $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule->getId()]);
                }
            }
        }
        $visites[] = new CtVisite();
        $receptions[] = new CtReception();
        $constatation[] = new CtConstAvDed();
        $constatation_caracteristique = new CtConstAvDedCarac();
        $constatations_caracteristiques[] = new CtConstAvDedCarac();
        $constatations_jointures = new CtConstAvDedsConstAvDedCaracs();
        if ($cg_vehicule != null) {
            if ($ctCarteGrise != null) {
                $visites = $this->getDoctrine()->getRepository(CtVisite::class)->findBy(['ctCarteGrise' => $ctCarteGrise->getId()], ['id' => 'DESC']);
            }
            // Récupération des réceptions
            if ($cg_vehicule != null) {
                $receptions = $this->getDoctrine()->getRepository(CtReception::class)->findBy(['ctVehicule' => $cg_vehicule->getId()], ['id' => 'DESC']);
            }
        }
        // Récupération des constatations avant dédouanement
        if ($cg_vehicule != null) {
            $constatations_caracteristiques = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findBy(['cadNumSerieType' => $cg_vehicule->getVhcNumSerie()]);
            $constatation_caracteristique = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['cadNumSerieType' => $cg_vehicule->getVhcNumSerie()], ['id' => 'DESC']);
            $constatations_jointures = $this->getDoctrine()->getRepository(CtConstAvDedsConstAvDedCaracs::class)->findOneBy(['const_av_ded_carac_id' => $constatation_caracteristique]);
            if ($constatations_jointures != null) {
                //$jointure = new CtConstAvDedsConstAvDedCaracs();
                //foreach ($jointure as $constatations_jointures) {
                    $constatation[] = $this->getDoctrine()->getRepository(CtConstAvDed::class)->findOneBy(['id' => $constatations_jointures->getConstAvDedId()]);
                //}
            }
        } else {
            $constatations_caracteristiques = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findBy(['cadNumSerieType' => $numero]);
            $constatation_caracteristique = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['cadNumSerieType' => $numero], ['id' => 'DESC']);
            $constatations_jointures = $this->getDoctrine()->getRepository(CtConstAvDedsConstAvDedCaracs::class)->findOneBy(['const_av_ded_carac_id' => $constatation_caracteristique]);
            if ($constatations_jointures != null) {
                //$jointure = new CtConstAvDedsConstAvDedCaracs();
                //foreach ($jointure as $constatations_jointures) {
                    $constatation[] = $this->getDoctrine()->getRepository(CtConstAvDed::class)->findOneBy(['id' => $constatations_jointures->getConstAvDedId()]);
                //}
            }
        }  
        if ($ctCarteGrise == null){
            $ctCarteGrise = new CtCarteGrise();
        }
        if ($rcp_immatriculation == null){
            $rcp_immatriculation = new CtReception();
        }
        if ($cg_vehicule == null){
            $cg_vehicule = new CtVehicule();
        }

        $response = new JsonResponse();
        $response = $this->json([$ctCarteGrise, $numero, $cg_vehicule, $visites, $receptions/*, $constatation, $constatations_caracteristiques */]); 
           
        return $response;
    }

    /**
     * @Route("/ct/manifeste", name="ct_manifeste", methods={"GET", "POST"})
     */
    public function manifeste(Request $request):Response
    {
        $numero = strtoupper($request->query->get('numero'));
        $numeros = explode(',', $numero);
        $receptions[] = new CtReception();
        $compte = 0;
        $compte2= 0;
        $non_recue = '';
        foreach($numeros as $num){
            $vehicule = new CtVehicule();
            $vehicules = $this->getDoctrine()->getRepository(CtVehicule::class)->findBy(['vhcNumSerie' => ' LIKE %'.$num.'%']);
            //$vehicules = $this->getDoctrine()->getRepository(CtVehicule::class)->findLike($num);
            foreach ($vehicules as $vehicule) {
                if ($vehicule != null) {
                    $receptionss = $this->getDoctrine()->getRepository(CtReception::class)->findBy(['ctVehicule' => $vehicule->getId()], ['id' => 'DESC']);
                    foreach ($receptionss as $rec) {
                        if ($rec != null) {
                            $receptions[$compte] = $rec;
                            $compte++;
                        }
                    }
                } else {
                    if ($non_recue != '') {
                        $non_recue .= ', ';
                    }
                    $non_recue .= $num;
                    $compte2++;
                }
            }
        }
        $numero .= ' nombre de véhicule trouvé : ' . $compte;
        $non_recue .= ' nombre de véhicule non trouvé : ' . $compte2;
        // Rendu pour affichage des informations obtenue
        return $this->render('ct_statistique/manifeste.html.twig', [
            'numero_de_serie' => $numero,
            'receptions' => $receptions,
            'non_recue' => $non_recue,
        ]);
    }

    /**
     * @Route("/ct/statistique/pdf", name="ct_pdf_historique", methods={"GET", "POST"})
     */
    public function pdf(Request $request)
    {
        $numero = strtoupper(trim($request->query->get('numero')));

        if($numero == ''){
            return $this->render('ct_statistique/recherche.html.twig');
        }
        $ctCarteGrise = new CtCarteGrise();
        $cg_vehicule = new CtCarteGrise();
        $vehicule_identification = new CtVehicule();
        // Récupération des informations de la carte grise
        $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['cgImmatriculation' => $numero]);
        if($ctCarteGrise == null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $numero]);
            $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule]);
        }

        $cg_vehicule = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['id' => $ctCarteGrise]);
        if($cg_vehicule == null){
            return $this->render('ct_statistique/recherche.html.twig');
        }
        $ns_vehicule = $cg_vehicule->getCtVehicule();
        $vehicule_identification = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['id' => $ns_vehicule]);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        $logo = $this->getParameter('image').'/logo_dgsr.png';
        $logo_data = base64_encode(file_get_contents($logo));
        $logo_src = 'data:image/png;base64,'.$logo_data;
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('ct_statistique/pdf.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
            'vehicule_identification' => $vehicule_identification,
            'logo' => $logo,
            'logos' => $logo_src,
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $fiche_technique = $ctCarteGrise->getCgImmatriculation();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("fiche_technique_".$fiche_technique.".pdf", [
            "Attachment" => true,
        ]);
        return new Response("Fichier pdf générer avec succés !");
        /* return $this->redirectToRoute('ct_statistique',[
            "numero" => $numero,
        ]); */
    }

    /**
     * @Route("/ct/identification", name="ct_identification", methods={"GET","POST"})
     */
    public function RechercheIdentification(Request $request): Response
    {
        $numero = strtoupper(trim($request->query->get('numero')));
        /* $numeros = explode(' ', $numero);
        $numero = "";
        foreach($numeros as $num){
            $numero .= strtoupper($num);
        } */

        if($numero == ''){
            return $this->render('ct_statistique/recherche_id.html.twig');
        }
        $ctCarteGrise = new CtCarteGrise();
        $cg_vehicule = new CtVehicule();
        $rcp_immatriculation = new CtReception();
        // Récupération des informations de la carte grise
        $id = $numero;
        $vst = $this->getDoctrine()->getRepository(CtVisite::class)->findOneBy(["id" => $id]);
        $ctCarteGrise = $vst->getCtCarteGrise();
        $visites[] = $vst;
        if ($ctCarteGrise == null){
            $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['cgImmatriculation' => $numero]);
        }
        if ($ctCarteGrise != null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $ctCarteGrise->getCtVehicule()->getVhcNumSerie()]);
        }
        if ($cg_vehicule == null || $ctCarteGrise == null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $numero]);
            if ($cg_vehicule != null) {
                $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule->getId()]);
            }
        }
        if($cg_vehicule == null || $ctCarteGrise == null){
            $rcp_immatriculation = $this->getDoctrine()->getRepository(CtReception::class)->findOneBy(['rcpImmatriculation' => $numero]);
            if ($rcp_immatriculation != null) {
                $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $rcp_immatriculation->getCtVehicule()->getVhcNumSerie()]);
                if ($cg_vehicule != null) {
                    $ctCarteGrise = $this->getDoctrine()->getRepository(CtCarteGrise::class)->findOneBy(['ctVehicule' => $cg_vehicule->getId()]);
                }
            }
        }

        // Rendu pou affichage des informations obtenue
        return $this->render('ct_statistique/index_id.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
            'numero_de_serie' => $numero,
            'vehicule_identification' => $cg_vehicule,
            'visites' => $visites,
        ]);
    }

    /**
     * @Route("/ct/identification/reception", name="ct_identification_reception", methods={"GET","POST"})
     */
    public function RechercheIdentificationReception(Request $request): Response
    {
        $numero = strtoupper(trim($request->query->get('numero')));
        /* $numeros = explode(' ', $numero);
        $numero = "";
        foreach($numeros as $num){
            $numero .= strtoupper($num);
        } */

        if($numero == ''){
            return $this->render('ct_statistique/recherche_id.html.twig');
        }
        $cg_vehicule = new CtVehicule();
        // Récupération des informations de la carte grise
        $id = $numero;
        $rcp = $this->getDoctrine()->getRepository(CtReception::class)->findOneBy(["id" => $id]);
        $cg_vehicule = $this->getDoctrine()->getRepository(CtReception::class)->findOneBy(['ctVehicule' => $rcp->getCtVehicule()]);
        $receptions[] = $rcp;

        // Rendu pou affichage des informations obtenue
        return $this->render('ct_statistique/index_id_reception.html.twig', [
            'numero_de_serie' => $numero,
            'vehicule_identification' => $cg_vehicule,
            'receptions' => $receptions,
        ]);
    }

    /**
     * @Route("/ct/identification/constatation", name="ct_identification_constatation", methods={"GET","POST"})
     */
    public function RechercheIdentificationConstatation(Request $request): Response
    {
        $numero = strtoupper(trim($request->query->get('numero')));
        /* $numeros = explode(' ', $numero);
        $numero = "";
        foreach($numeros as $num){
            $numero .= strtoupper($num);
        } */

        if($numero == ''){
            return $this->render('ct_statistique/recherche_id.html.twig');
        }
        // Récupération des informations de la carte grise
        $id = $numero;
        $cad = $this->getDoctrine()->getRepository(CtConstAvDed::class)->findOneBy(["id" => $id]);
        //var_dump($cad);
        $constatation[] = $cad;
        $constatations_caracteristiques = new ArrayCollection();
        $constatations_jointures = $this->getDoctrine()->getRepository(CtConstAvDedsConstAvDedCaracs::class)->findBy(['const_av_ded_id' => $id]);
        if ($constatations_jointures != null) {
            foreach ($constatations_jointures as $jointure) {
                $constatations_caracteristiques->add($this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['id' => $jointure->getConstAvDedCaracId()]));
            }
        }

        // Rendu pou affichage des informations obtenue
        return $this->render('ct_statistique/index_id_constatation.html.twig', [
            'numero_de_serie' => $numero,
            'ct_const_av_ded_caracs' => $constatations_caracteristiques,
            'ct_const_av_deds' => $constatation,
        ]);
    }
}
