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
     * @Route("/ct/identification", name="ct_identification_visite", methods={"GET","POST"})
     */
    public function RechercheIdentificationVisite(Request $request): Response
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
        if ($ctCarteGrise != null){
            $cg_vehicule = $this->getDoctrine()->getRepository(CtVehicule::class)->findOneBy(['vhcNumSerie' => $ctCarteGrise->getCtVehicule()->getVhcNumSerie()]);
        }
        $visite = [
            "id" => $vst->getId()?$vst->getId():"",
            "centre" => $vst->getCtCentre()?$vst->getCtCentre()->getCtrNom():"",
            "type_visite" => $vst->getCtTypeVisite()?$vst->getCtTypeVisite()->getTpvLibelle():"",
            "usage" => $vst->getCtUsage()?$vst->getCtUsage()->getUsgLibelle():"",
            "secretaire" => $vst->getCtUser()?$vst->getCtUser()->getUsrName():"",
            "verificateur" => $vst->getCtVerificateur()?$vst->getCtVerificateur()->getUsrName():"",
            "numero_controle" => $vst->getVstNumPv()?$vst->getVstNumPv():"",
            "date_expiration" => $vst->getVstDateExpiration()?$vst->getVstDateExpiration()->format('m/d/Y'):"",
            "date_visite" => $vst->getVstCreated()?$vst->getVstCreated()->format('m/d/Y'):"",
            "date_modification" => $vst->getVstUpdated()?$vst->getVstUpdated()->format('m/d/Y'):"",
            "utilisation" => $vst->getCtUtilisation()?$vst->getCtUtilisation()->getUtLibelle():"",
            "aptitude" => $vst->getVstIsApte()?"Apte":"Inapte",
            "mode_visite" => $vst->getVstIsContreVisite()?"Contre visite":"Visite première",
            "duree_reparation" => $vst->getVstDureeReparation()?$vst->getVstDureeReparation():"",
        ];
        $carte_grise = [
            "id" => $ctCarteGrise->getId()?$ctCarteGrise->getId():"",
            "carrosserie" => $ctCarteGrise->getCtCarosserie()?$ctCarteGrise->getCtCarosserie()->getCrsLibelle():"",
            "centre" => $ctCarteGrise->getCtCentre()?$ctCarteGrise->getCtCentre()->getCtrNom():"",
            "source_energie" => $ctCarteGrise->getCtSourceEnergie()?$ctCarteGrise->getCtSourceEnergie()->getSreLibelle():"",
            "date_emission" => $ctCarteGrise->getCgDateEmission()?$ctCarteGrise->getCgDateEmission()->format('m/d/Y'):"",
            "nom" => $ctCarteGrise->getCgNom()?$ctCarteGrise->getCgNom():"",
            "prenom" => $ctCarteGrise->getCgPrenom()?$ctCarteGrise->getCgPrenom():"",
            "profession" => $ctCarteGrise->getCgProfession()?$ctCarteGrise->getCgProfession():"",
            "adresse" => $ctCarteGrise->getCgAdresse()?$ctCarteGrise->getCgAdresse():"",
            "telephone" => $ctCarteGrise->getCgPhone()?$ctCarteGrise->getCgPhone():"",
            "commune" => $ctCarteGrise->getCgCommune()?$ctCarteGrise->getCgCommune():"",
            "nombre_place_assis" => $ctCarteGrise->getCgNbrAssis()?$ctCarteGrise->getCgNbrAssis():"",
            "nombre_place_debout" => $ctCarteGrise->getCgNbrDebout()?$ctCarteGrise->getCgNbrDebout():"",
            "puissance" => $ctCarteGrise->getCgPuissanceAdmin()?$ctCarteGrise->getCgPuissanceAdmin():"",
            "date_mise_en_service" => $ctCarteGrise->getCgMiseEnService()?$ctCarteGrise->getCgMiseEnService()->format('m/d/Y'):"",
            "patente" => $ctCarteGrise->getCgPatente()?$ctCarteGrise->getCgPatente():"",
            "ani" => $ctCarteGrise->getCgAni()?$ctCarteGrise->getCgAni():"",
            "rta" => $ctCarteGrise->getCgRta()?$ctCarteGrise->getCgRta():"",
            "num_carte_violette" => $ctCarteGrise->getCgNumCarteViolette()?$ctCarteGrise->getCgNumCarteViolette():"",
            "date_carte_violette" => $ctCarteGrise->getCgDateCarteViolette()?$ctCarteGrise->getCgDateCarteViolette()->format('m/d/Y'):"",
            "lieu_carte_violette" => $ctCarteGrise->getCgLieuCarteViolette()?$ctCarteGrise->getCgLieuCarteViolette():"",
            "licence" => $ctCarteGrise->getCgNumVignette()?$ctCarteGrise->getCgNumVignette():"",
            "date_licence" => $ctCarteGrise->getCgDateVignette()?$ctCarteGrise->getCgDateVignette()->format('m/d/Y'):"",
            "lieu_licence" => $ctCarteGrise->getCgLieuVignette()?$ctCarteGrise->getCgLieuVignette():"",
            "immatriculation" => $ctCarteGrise->getCgImmatriculation()?$ctCarteGrise->getCgImmatriculation():"",
            "date" => $ctCarteGrise->getCgCreated()?$ctCarteGrise->getCgCreated()->format('m/d/Y'):"",
            "nom_cooperative" => $ctCarteGrise->getCgNomCooperative()?$ctCarteGrise->getCgNomCooperative():"",
            "itineraire" => $ctCarteGrise->getCgItineraire()?$ctCarteGrise->getCgItineraire():"",
            "transporteur" => $ctCarteGrise->getCgIsTransport()?$ctCarteGrise->getCgIsTransport():"",
            "numero_identification" => $ctCarteGrise->getCgNumIdentification()?$ctCarteGrise->getCgNumIdentification():"",
            "zone_desserte" => $ctCarteGrise->getCtZoneDeserte()?$ctCarteGrise->getCtZoneDeserte()->getZdLibelle():"",
        ];
        $vehicule = [
            "id" => $cg_vehicule->getId()?$cg_vehicule->getId():"",
            "genre" => $cg_vehicule->getCtGenre()?$cg_vehicule->getCtGenre()->getGrLibelle():"",
            "marque" => $cg_vehicule->getCtMarque()?$cg_vehicule->getCtMarque()->getMrqLibelle():"",
            "cylindre" => $cg_vehicule->getVhcCylindre()?$cg_vehicule->getVhcCylindre():"",
            "puissance" => $cg_vehicule->getVhcPuissance()?$cg_vehicule->getVhcPuissance():"",
            "poids_a_vide" => $cg_vehicule->getVhcPoidsVide()?$cg_vehicule->getVhcPoidsVide():"",
            "charge_utile" => $cg_vehicule->getVhcChargeUtile()?$cg_vehicule->getVhcChargeUtile():"",
            "hauteur" => $cg_vehicule->getVhcHauteur()?$cg_vehicule->getVhcHauteur():"",
            "largeur" => $cg_vehicule->getVhcLargeur()?$cg_vehicule->getVhcLargeur():"",
            "longueur" => $cg_vehicule->getVhcLongueur()?$cg_vehicule->getVhcLongueur():"",
            "numero_serie" => $cg_vehicule->getVhcNumSerie()?$cg_vehicule->getVhcNumSerie():"",
            "numero_moteur" => $cg_vehicule->getVhcNumMoteur()?$cg_vehicule->getVhcNumMoteur():"",
            "date" => $cg_vehicule->getVhcCreated()?$cg_vehicule->getVhcCreated()->format('m/d/Y'):"",
            "type" => $cg_vehicule->getVhcType()?$cg_vehicule->getVhcType():"",
            "poids_total_a_charge" => $cg_vehicule-> getVhcPoidsTotalCharge()?$cg_vehicule-> getVhcPoidsTotalCharge():"",
        ];

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response = $this->json([$visite, $carte_grise, $vehicule]);

        return $response;

        // Rendu pou affichage des informations obtenue
        /* return $this->render('ct_statistique/index_id.html.twig', [
            'ct_carte_grise' => $ctCarteGrise,
            'numero_de_serie' => $numero,
            'vehicule_identification' => $cg_vehicule,
            'visites' => $visites,
        ]); */
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
        //$cg_vehicule = $this->getDoctrine()->getRepository(CtReception::class)->findOneBy(['ctVehicule' => $rcp->getCtVehicule()]);
        $cg_vehicule = $rcp->getCtVehicule();
        //$receptions[] = $rcp;
        $reception = [
            "id" => $rcp->getId()?$rcp->getId():"",
            "centre" => $rcp->getCtCentre()?$rcp->getCtCentre()->getCtrNom():"",
            "motif" => $rcp->getCtMotif()?$rcp->getCtMotif()->getMtfLibelle():"",
            "type_reception" => $rcp->getCtTypeReception()?$rcp->getCtTypeReception()->getTprcpLibelle():"",
            "secretaire" => $rcp->getCtUser()?$rcp->getCtUser()->getUsrName():"",
            "utilisation" => $rcp->getCtUtilisation()?$rcp->getCtUtilisation()->getUtLibelle():"",
            "date_mise_en_service" => $rcp->getRcpMiseService()?$rcp->getRcpMiseService()->format('m/d/Y'):"",
            "immatriculation" => $rcp->getRcpImmatriculation()?$rcp->getRcpImmatriculation():"",
            "proprietaire" => $rcp->getRcpProprietaire()?$rcp->getRcpProprietaire():"",
            "profession" => $rcp->getRcpProfession()?$rcp->getRcpProfession():"",
            "adresse" => $rcp->getRcpAdresse()?$rcp->getRcpAdresse():"",
            "nombre_place_assis" => $rcp->getRcpNbrAssis()?$rcp->getRcpNbrAssis():"",
            "nombre_place_debout" => $rcp->getRcpNbrDebout()?$rcp->getRcpNbrDebout():"",
            "numero_controle" => $rcp->getRcpNumPv()?$rcp->getRcpNumPv():"",
            "source_energie" => $rcp->getCtSourceEnergie()?$rcp->getCtSourceEnergie()->getSreLibelle():"",
            "carrosserie" => $rcp->getCtCarosserie()?$rcp->getCtCarosserie()->getCrsLibelle():"",
            "date" => $rcp->getRcpCreated()?$rcp->getRcpCreated()->format('m/d/Y'):"",
            "genre" => $rcp->getCtGenre()?$rcp->getCtGenre()->getGrLibelle():"",
        ];
        $vehicule = [
            "id" => $cg_vehicule->getId()?$cg_vehicule->getId():"",
            "genre" => $cg_vehicule->getCtGenre()?$cg_vehicule->getCtGenre()->getGrLibelle():"",
            "marque" => $cg_vehicule->getCtMarque()?$cg_vehicule->getCtMarque()->getMrqLibelle():"",
            "cylindre" => $cg_vehicule->getVhcCylindre()?$cg_vehicule->getVhcCylindre():"",
            "puissance" => $cg_vehicule->getVhcPuissance()?$cg_vehicule->getVhcPuissance():"",
            "poids_a_vide" => $cg_vehicule->getVhcPoidsVide()?$cg_vehicule->getVhcPoidsVide():"",
            "charge_utile" => $cg_vehicule->getVhcChargeUtile()?$cg_vehicule->getVhcChargeUtile():"",
            "hauteur" => $cg_vehicule->getVhcHauteur()?$cg_vehicule->getVhcHauteur():"",
            "largeur" => $cg_vehicule->getVhcLargeur()?$cg_vehicule->getVhcLargeur():"",
            "longueur" => $cg_vehicule->getVhcLongueur()?$cg_vehicule->getVhcLongueur():"",
            "numero_serie" => $cg_vehicule->getVhcNumSerie()?$cg_vehicule->getVhcNumSerie():"",
            "numero_moteur" => $cg_vehicule->getVhcNumMoteur()?$cg_vehicule->getVhcNumMoteur():"",
            "date" => $cg_vehicule->getVhcCreated()?$cg_vehicule->getVhcCreated()->format('m/d/Y'):"",
            "type" => $cg_vehicule->getVhcType()?$cg_vehicule->getVhcType():"",
            "poids_total_a_charge" => $cg_vehicule-> getVhcPoidsTotalCharge()?$cg_vehicule-> getVhcPoidsTotalCharge():"",
        ];

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response = $this->json([$reception, $vehicule]);

        return $response;

        // Rendu pou affichage des informations obtenue
        /* return $this->render('ct_statistique/index_id_reception.html.twig', [
            'numero_de_serie' => $numero,
            'vehicule_identification' => $cg_vehicule,
            'receptions' => $receptions,
        ]); */
    }

    /**
     * @Route("/ct/identification/constatation", name="ct_identification_constatation", methods={"GET","POST"})
     */
    public function RechercheIdentificationConstatation(Request $request): Response
    {
        $numero = strtoupper(trim($request->query->get('numero')));
        $constatation_carte_grise = [
            "id" => "",
            "carrosserie" => "",
            "type" => "Carte grise",
            "genre" => "",
            "marque" => "",
            "source_energie" => "",
            "cylindre" => "",
            "puissance" => "",
            "poids_a_vide" => "",
            "charge_utile" => "",
            "hauteur" => "",
            "largeur" => "",
            "longueur" => "",
            "numero_serie" => "",
            "numero_moteur" => "",
            "typ_car" => "",
            "ptac" => "",
            "date_premiere_circulation" => "",
            "nombre_place_assis" => "",
        ];
        $constatation_corps_vehicule = [
            "id" => "",
            "carrosserie" => "",
            "type" => "Corps du véhicule",
            "genre" => "",
            "marque" => "",
            "source_energie" => "",
            "cylindre" => "",
            "puissance" => "",
            "poids_a_vide" => "",
            "charge_utile" => "",
            "hauteur" => "",
            "largeur" => "",
            "longueur" => "",
            "numero_serie" => "",
            "numero_moteur" => "",
            "typ_car" => "",
            "ptac" => "",
            "date_premiere_circulation" => "",
            "nombre_place_assis" => "",
        ];
        $constatation_note_descriptive = [
            "id" => "",
            "carrosserie" => "",
            "type" => "Note descriptive",
            "genre" => "",
            "marque" => "",
            "source_energie" => "",
            "cylindre" => "",
            "puissance" => "",
            "poids_a_vide" => "",
            "charge_utile" => "",
            "hauteur" => "",
            "largeur" => "",
            "longueur" => "",
            "numero_serie" => "",
            "numero_moteur" => "",
            "typ_car" => "",
            "ptac" => "",
            "date_premiere_circulation" => "",
            "nombre_place_assis" => "",
        ];

        if($numero == ''){
            return $this->render('ct_statistique/recherche_id.html.twig');
        }
        // Récupération des informations de la carte grise
        $id = $numero;
        $cad = $this->getDoctrine()->getRepository(CtConstAvDed::class)->findOneBy(["id" => $id]);
        //var_dump($cad);
        $constatation[] = $cad;
        $constatation_information = [
            "id" => $id?$id:"",
            "centre" => $cad->getCtCentre()?$cad->getCtCentre()->getCtrNom():"",
            "verificateur" => $cad->getCtVerificateur()?$cad->getCtVerificateur()->getUsrName():"",
            "provenance" => $cad->getCadProvenance()?$cad->getCadProvenance():"",
            "divers" => $cad->getCadDivers()?$cad->getCadDivers():"",
            "nom_proprietaire" => $cad->getCadProprietaireNom()?$cad->getCadProprietaireNom():"",
            "adresse_proprietaire" => $cad->getCadProprietaireAdresse()?$cad->getCadProprietaireAdresse():"",
            "etat" => $cad->getCadBonEtat()?"Bon":"Mauvaise",
            "sec_pers" => $cad->getCadSecPers()?"Oui":"Non",
            "sec_march" => $cad->getCadSecMarch()?"Oui":"Non",
            "protec_env" => $cad->getCadProtecEnv()?"Oui":"Non",
            "numero_ctrl" => $cad->getCadNumero()?$cad->getCadNumero():"",
            "immatriculation" => $cad->getCadImmatriculation()?$cad->getCadImmatriculation():"",
            "date_embarquement" => $cad->getCadDateEmbarquement()?$cad->getCadDateEmbarquement()->format('m/d/Y'):"",
            "lieu_embarquement" => $cad->getCadLieuEmbarquement()?$cad->getCadLieuEmbarquement():"",
            "date" => $cad->getCadCreated()?$cad->getCadCreated()->format('m/d/Y'):"",
            "conformite" => $cad->getCadConforme()?"Conforme":"Non conforme",
            "observation" => $cad->getCadObservation()?$cad->getCadObservation():"",
        ];
        $constatations_caracteristiques = new ArrayCollection();
        $constatations_jointures = $this->getDoctrine()->getRepository(CtConstAvDedsConstAvDedCaracs::class)->findBy(['const_av_ded_id' => $id]);
        if ($constatations_jointures != null) {
            foreach ($constatations_jointures as $jointure) {
                $constatations_caracteristiques->add($this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['id' => $jointure->getConstAvDedCaracId()]));
                $const_carac = $this->getDoctrine()->getRepository(CtConstAvDedCarac::class)->findOneBy(['id' => $jointure->getConstAvDedCaracId()]);
                switch ($const_carac->getCtConstAvDedType()->getId()){
                    case 1:
                        $constatation_carte_grise = [
                            "id" => $const_carac->getId()?$const_carac->getId():"",
                            "carrosserie" => $const_carac->getCtCarosserie()?$const_carac->getCtCarosserie()->getCrsLibelle():"",
                            "type" => $const_carac->getCtConstAvDedType()?$const_carac->getCtConstAvDedType()->getCadTpLibelle():"",
                            "genre" => $const_carac->getCtGenre()?$const_carac->getCtGenre()->getGrLibelle():"",
                            "marque" => $const_carac->getCtMarque()?$const_carac->getCtMarque()->getMrqLibelle():"",
                            "source_energie" => $const_carac->getCtSourceEnergie()?$const_carac->getCtSourceEnergie()->getSreLibelle():"",
                            "cylindre" => $const_carac->getCadCylindre()?$const_carac->getCadCylindre():"",
                            "puissance" => $const_carac->getCadPuissance()?$const_carac->getCadPuissance():"",
                            "poids_a_vide" => $const_carac->getCadPoidsVide()?$const_carac->getCadPoidsVide():"",
                            "charge_utile" => $const_carac->getCadChargeUtile()?$const_carac->getCadChargeUtile():"",
                            "hauteur" => $const_carac->getCadHauteur()?$const_carac->getCadHauteur():"",
                            "largeur" => $const_carac->getCadLargeur()?$const_carac->getCadLargeur():"",
                            "longueur" => $const_carac->getCadLongueur()?$const_carac->getCadLongueur():"",
                            "numero_serie" => $const_carac->getCadNumSerieType()?$const_carac->getCadNumSerieType():"",
                            "numero_moteur" => $const_carac->getCadNumMoteur()?$const_carac->getCadNumMoteur():"",
                            "typ_car" => $const_carac->getCadTypeCar()?$const_carac->getCadTypeCar():"",
                            "ptac" => $const_carac->getCadPoidsTotalCharge()?$const_carac->getCadPoidsTotalCharge():"",
                            "date_premiere_circulation" => $const_carac->getCadPremiereCircule()?$const_carac->getCadPremiereCircule():"",
                            "nombre_place_assis" => $const_carac->getCadNbrAssis()?$const_carac->getCadNbrAssis():"",
                        ];
                        break;
                    case 2:
                        $constatation_corps_vehicule = [
                            "id" => $const_carac->getId()?$const_carac->getId():"",
                            "carrosserie" => $const_carac->getCtCarosserie()?$const_carac->getCtCarosserie()->getCrsLibelle():"",
                            "type" => $const_carac->getCtConstAvDedType()?$const_carac->getCtConstAvDedType()->getCadTpLibelle():"",
                            "genre" => $const_carac->getCtGenre()?$const_carac->getCtGenre()->getGrLibelle():"",
                            "marque" => $const_carac->getCtMarque()?$const_carac->getCtMarque()->getMrqLibelle():"",
                            "source_energie" => $const_carac->getCtSourceEnergie()?$const_carac->getCtSourceEnergie()->getSreLibelle():"",
                            "cylindre" => $const_carac->getCadCylindre()?$const_carac->getCadCylindre():"",
                            "puissance" => $const_carac->getCadPuissance()?$const_carac->getCadPuissance():"",
                            "poids_a_vide" => $const_carac->getCadPoidsVide()?$const_carac->getCadPoidsVide():"",
                            "charge_utile" => $const_carac->getCadChargeUtile()?$const_carac->getCadChargeUtile():"",
                            "hauteur" => $const_carac->getCadHauteur()?$const_carac->getCadHauteur():"",
                            "largeur" => $const_carac->getCadLargeur()?$const_carac->getCadLargeur():"",
                            "longueur" => $const_carac->getCadLongueur()?$const_carac->getCadLongueur():"",
                            "numero_serie" => $const_carac->getCadNumSerieType()?$const_carac->getCadNumSerieType():"",
                            "numero_moteur" => $const_carac->getCadNumMoteur()?$const_carac->getCadNumMoteur():"",
                            "typ_car" => $const_carac->getCadTypeCar()?$const_carac->getCadTypeCar():"",
                            "ptac" => $const_carac->getCadPoidsTotalCharge()?$const_carac->getCadPoidsTotalCharge():"",
                            "date_premiere_circulation" => $const_carac->getCadPremiereCircule()?$const_carac->getCadPremiereCircule():"",
                            "nombre_place_assis" => $const_carac->getCadNbrAssis()?$const_carac->getCadNbrAssis():"",
                        ];
                        break;
                    case 3:
                        $constatation_note_descriptive = [
                            "id" => $const_carac->getId()?$const_carac->getId():"",
                            "carrosserie" => $const_carac->getCtCarosserie()?$const_carac->getCtCarosserie()->getCrsLibelle():"",
                            "type" => $const_carac->getCtConstAvDedType()?$const_carac->getCtConstAvDedType()->getCadTpLibelle():"",
                            "genre" => $const_carac->getCtGenre()?$const_carac->getCtGenre()->getGrLibelle():"",
                            "marque" => $const_carac->getCtMarque()?$const_carac->getCtMarque()->getMrqLibelle():"",
                            "source_energie" => $const_carac->getCtSourceEnergie()?$const_carac->getCtSourceEnergie()->getSreLibelle():"",
                            "cylindre" => $const_carac->getCadCylindre()?$const_carac->getCadCylindre():"",
                            "puissance" => $const_carac->getCadPuissance()?$const_carac->getCadPuissance():"",
                            "poids_a_vide" => $const_carac->getCadPoidsVide()?$const_carac->getCadPoidsVide():"",
                            "charge_utile" => $const_carac->getCadChargeUtile()?$const_carac->getCadChargeUtile():"",
                            "hauteur" => $const_carac->getCadHauteur()?$const_carac->getCadHauteur():"",
                            "largeur" => $const_carac->getCadLargeur()?$const_carac->getCadLargeur():"",
                            "longueur" => $const_carac->getCadLongueur()?$const_carac->getCadLongueur():"",
                            "numero_serie" => $const_carac->getCadNumSerieType()?$const_carac->getCadNumSerieType():"",
                            "numero_moteur" => $const_carac->getCadNumMoteur()?$const_carac->getCadNumMoteur():"",
                            "typ_car" => $const_carac->getCadTypeCar()?$const_carac->getCadTypeCar():"",
                            "ptac" => $const_carac->getCadPoidsTotalCharge()?$const_carac->getCadPoidsTotalCharge():"",
                            "date_premiere_circulation" => $const_carac->getCadPremiereCircule()?$const_carac->getCadPremiereCircule():"",
                            "nombre_place_assis" => $const_carac->getCadNbrAssis()?$const_carac->getCadNbrAssis():"",
                        ];
                        break;
                }
            }
        }

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response = $this->json([$constatation_information, $constatation_carte_grise, $constatation_corps_vehicule, $constatation_note_descriptive]);

        return $response;

        // Rendu pou affichage des informations obtenue
        /* return $this->render('ct_statistique/index_id_constatation.html.twig', [
            'numero_de_serie' => $numero,
            'ct_const_av_ded_caracs' => $constatations_caracteristiques,
            'ct_const_av_deds' => $constatation,
        ]); */
    }
}
