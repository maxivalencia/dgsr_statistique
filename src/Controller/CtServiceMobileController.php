<?php

namespace App\Controller;


use App\Repository\CtCarteGriseRepository;
use App\Repository\CtVisiteRepository;
use App\Repository\CtVehiculeRepository;
use App\Repository\CtCarosserieRepository;
use App\Repository\CtSourceEnergieRepository;
use App\Repository\CtMarqueRepository;
use App\Repository\CtGenreRepository;
use App\Repository\CtCentreRepository;
use App\Repository\CtProvinceRepository;
use App\Repository\CtUsageRepository;
use App\Repository\CtUserRepository;
use App\Repository\CtUtilisationRepository;
use App\Repository\CtVisiteAnomalieRepository;
use App\Repository\CtAnomalieRepository;
use App\Repository\CtImprimeTechUseRepository;
use App\Repository\CtImprimeTechRepository;
use App\Entity\ImprimeTech;
use App\Entity\CtCarteGrise;
use App\Entity\CtImprimeTechUse;
use App\Entity\CtAutreSce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Route("/ct/service", name="ct_service_mobile")
 */
class CtServiceMobileController extends AbstractController
{
    /**
     * @Route("/mobile", name="ct_service_mobile")
     */
    public function index()
    {
        return $this->render('ct_service_mobile/index.html.twig', [
            'controller_name' => 'CtServiceMobileController',
        ]);
    }

    /**
     * @Route("/mobile/recherche/proprietaire", name="ct_service_mobile_recherche_immatriculation_proprietaire", methods={"GET", "POST"})
     */
    public function rechercheProprietaire(Request $request, CtCarteGriseRepository $ctCarteGriseRepository)
    {
        $information_vehicule = [
            "nom_chauffeur" => "",
            "contact_chauffeur" => "",
            "nom_proprietaire" => "",
            "contact_proprietaire" => "",
        ];
        $immatriculation = $request->query->get('immatriculation');
        $info = new CtCarteGrise();
        $liste_info = $ctCarteGriseRepository->findInfoProprietaire($immatriculation);
        if(count($liste_info) == 1){
            foreach($liste_info as $lst_i){
                $information_vehicule = [
                    "nom_chauffeur" => "",
                    "contact_chauffeur" => "",
                    "nom_proprietaire" => $lst_i->getCgNom().' '.$lst_i->getCgPrenom(),
                    "contact_proprietaire" => $lst_i->getCgPhone(),
                ];
            }
        }
        $response = new JsonResponse($information_vehicule);
        $response->headers->set('Access-Control-Allow-Headers', '*');
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');

        return $response;
    }

    /**
     * @Route("/mobile/recherche", name="ct_service_mobile_recherche_immatriculation", methods={"GET", "POST"})
     */
    public function recherche(Request $request, CtImprimeTechUseRepository $ctImprimeTechUseRepository, CtAnomalieRepository $ctAnomalieRepository, CtVisiteAnomalieRepository $ctVisiteAnomalieRepository, CtUtilisationRepository $ctUtilisationRepository, CtUserRepository $ctUserRepository, CtUsageRepository $ctUsageRepository, CtProvinceRepository $ctProvinceRepository, CtCentreRepository $ctCentreRepository, CtVisiteRepository $ctVisiteRepository, CtGenreRepository $ctGenreRepository, CtMarqueRepository $ctMarqueRepository, CtSourceEnergieRepository $ctSourceEnergieRepository, CtCarteGriseRepository $ctCarteGriseRepository, CtVehiculeRepository $ctVehiculeRepository, CtCarosserieRepository $ctCarosserieRepository)
    {
        $array_vehicule = new ArrayCollection();
        $info_vehicule = [
            "cg_immatriculation" => "",
            "cg_nom" => "",
            "cg_prenom" => "",
            "cg_phone" => "",
            "cg_profession" => "",
            "cg_nom_cooperative" => "",
            "cg_adresse" => "C",
            "cg_commune" => "",
            "cg_puissance_admin" => "",
            "cg_nbr_assis" => "",
            "cg_nbr_debout" => "",
            "cg_mise_en_service" => "",
            "cg_num_carte_violette" => "",
            "cg_date_carte_violette" => "",
            "cg_patente" => "",
            "cg_ani" => "",
            "cg_num_vignette" => "",
            "cg_date_vignette" => "",
            "crs_libelle" => "",
            "sre_libelle" => "",
            "vhc_num_serie" => "",
            "vhc_num_moteur" => "",
            "vhc_type" => "",
            "vhc_charge_utile" => "",
            "vhc_poids_vide" => "",
            "vhc_poids_total_charge" => "",
            "mrq_libelle" => "",
            "gr_libelle" => "",
            "vst_num_pv" => "",
            "vst_date_expiration" => "",
            "vst_is_apte" => "",
            "vst_is_contre_visite" => "",
            "vst_created" => "",
            "ctr_nom" => "",
            "prv_nom" => "",
            "usg_libelle" => "",
            "nom_verificateur" => "",
            "usr_name" => "",
            "ut_libelle" => "",
            "vst_anomalies" => "",
            "imprime" => "",
        ];
        $separateurs = ["", " ", ".", "_", "-"];
        $separateurs_saisie = ["", " ", ".", "_", "-"];
        $immatriculation = $request->get("IMM");
        if($immatriculation == null){
            $immatriculation = $request->query->get("IMM");
        }
        if($immatriculation == null){
            $immatriculation = $request->request->get("IMM");
        }
        $chiffre_immatriculation = substr($immatriculation, 0, 4);
        $lettre_immatriculation = strtoupper(substr($immatriculation, 4));
        foreach($separateurs_saisie as $separateur){
            if(substr($lettre_immatriculation, 0, 1) == $separateur){
                $lettre_immatriculation = substr($lettre_immatriculation, 1);
            }
        }
        try {
            foreach($separateurs as $separateur){
                $imm = $chiffre_immatriculation.$separateur.$lettre_immatriculation;
                $carte_grise = $ctCarteGriseRepository->findOneBy(["cgImmatriculation" => $imm]);
                if($carte_grise != null) {
                    $vehicule = $ctVehiculeRepository->findOneBy(["id" => $carte_grise->getCtVehicule()]);
                    $carosserie = $ctCarosserieRepository->findOneBy(["id" => $carte_grise->getCtCarosserie()]);
                    $source_energie = $ctSourceEnergieRepository->findOneBy(["id" => $carte_grise->getCtSourceEnergie()]);
                    $marque = $ctMarqueRepository->findOneBy(["id" => $vehicule->getCtMarque()]);
                    $genre = $ctGenreRepository->findOneBy(["id" => $vehicule->getCtGenre()]);
                    $visite = $ctVisiteRepository->findOneBy(["ctCarteGrise" => $carte_grise->getId()], ["id" => "DESC"]);
                    $centre = $ctCentreRepository->findOneBy(["id" => $visite->getCtCentre()]);
                    $province = $ctProvinceRepository->findOneBy(["id" => $centre->getCtProvince()]);
                    $usage = $ctUsageRepository->findOneBy(["id" => $visite->getCtUsage()]);
                    $verificateur = $ctUserRepository->findOneBy(["id" => $visite->getCtVerificateur()]);
                    $secretaire = $ctUserRepository->findOneBy(["id" => $visite->getCtUser()]);
                    $utilisation = $ctUtilisationRepository->findOneBy(["id" => $visite->getCtUtilisation()]);
                    $liste_anomalies = "";
                    $liste_imprime = "";
                    //$imprimes = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Visite"]);
                    $imprimesVisite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Visite"]);
                    $imprimesContre = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Contre"]);
                    $imprimes = array_merge($imprimesVisite, $imprimesContre);
                    if($visite->getVstIsApte() == 0){
                        //$anomalies = $ctVisiteAnomalieRepository->find(["ctAnomalieId" => $visite->getId()]);
                        $anomalies = $ctVisiteAnomalieRepository->findAnomalie($visite->getId());
                        foreach($anomalies as $anomalie) {
                            if($liste_anomalies != ""){
                                $liste_anomalies .= " - ";
                            }
                            $anomal = $ctAnomalieRepository->findOneBy(["id" => $anomalie]);
                            $liste_anomalies .= $anomal->getAnmlLibelle();
                            //$liste_anomalies = (string)$liste_anomalies.(string)$anomalie." ";
                        }
                    }
                    foreach($imprimes as $imp){
                        if($liste_imprime != ""){
                            $liste_imprime .= " - ";
                        }
                        $liste_imprime .= $imp->getCtImprimeTech()->getAbrevImprimeTech() . " : " . $imp->getItuNumero();
                    }
                    $autresService = $this->getDoctrine()->getRepository(CtAutreSce::class)->findBy(["ctControleId" => $visite->getId()]);
                    foreach($autresService as $aS){
                        $imprimesAutreService = $ctImprimeTechUseRepository->findBy(["ctControleId" => $aS->getId()]);
                        foreach($imprimesAutreService as $impAS){
                            if($liste_imprime != ""){
                                $liste_imprime .= " - ";
                            }
                            $liste_imprime .= $impAS->getCtImprimeTech()->getAbrevImprimeTech() . " : " . $impAS->getItuNumero();
                        }
                    }
                    $info_vehicule = [
                        "cg_immatriculation" => $carte_grise->getCgImmatriculation()?(string)$carte_grise->getCgImmatriculation():"",
                        "cg_nom" => $carte_grise->getCgNom()?(string)$carte_grise->getCgNom():"",
                        "cg_prenom" => trim((string)$carte_grise->getCgPrenom()),
                        "cg_phone" => trim((string)$carte_grise->getCgPhone()),
                        "cg_profession" => $carte_grise->getCgProfession()?(string)$carte_grise->getCgProfession():"",
                        "cg_nom_cooperative" => $carte_grise->getCgNomCooperative()?(string)$carte_grise->getCgNomCooperative():"",
                        "cg_adresse" => $carte_grise->getCgAdresse()?(string)$carte_grise->getCgAdresse():"",
                        "cg_commune" => $carte_grise->getCgCommune()?(string)$carte_grise->getCgCommune():"",
                        "cg_puissance_admin" => $carte_grise->getCgPuissanceAdmin()?(string)$carte_grise->getCgPuissanceAdmin():"",
                        "cg_nbr_assis" => $carte_grise->getCgNbrAssis()?(string)$carte_grise->getCgNbrAssis():"",
                        "cg_nbr_debout" => $carte_grise->getCgNbrDebout()?(string)$carte_grise->getCgNbrDebout():"",
                        "cg_mise_en_service" => $carte_grise->getCgMiseEnService()->format('Y-m-d')?(string)$carte_grise->getCgMiseEnService()->format('Y-m-d'):"",
                        "cg_num_carte_violette" => $carte_grise->getCgNumCarteViolette()?(string)$carte_grise->getCgNumCarteViolette():"",
                        "cg_date_carte_violette" => $carte_grise->getCgDateCarteViolette()?(string)$carte_grise->getCgDateCarteViolette()->format('Y-m-d'):"",
                        "cg_patente" => $carte_grise->getCgPatente()?(string)$carte_grise->getCgPatente():"",
                        "cg_ani" => $carte_grise->getCgAni()?(string)$carte_grise->getCgAni():"",
                        "cg_num_vignette" => $carte_grise->getCgNumVignette()?(string)$carte_grise->getCgNumVignette():"",
                        "cg_date_vignette" => $carte_grise->getCgDateVignette()->format('Y-m-d')?(string)$carte_grise->getCgDateVignette()->format('Y-m-d'):"",
                        "crs_libelle" => $carosserie->getCrsLibelle()?(string)$carosserie->getCrsLibelle():"",
                        "sre_libelle" => $source_energie->getSreLibelle()?(string)$source_energie->getSreLibelle():"",
                        "vhc_num_serie" => $vehicule->getVhcNumSerie()?(string)$vehicule->getVhcNumSerie():"",
                        "vhc_num_moteur" => $vehicule->getVhcNumMoteur()?(string)$vehicule->getVhcNumMoteur():"",
                        "vhc_type" => $vehicule->getVhcType()?(string)$vehicule->getVhcType():"",
                        "vhc_charge_utile" => $vehicule->getVhcChargeUtile()?(string)$vehicule->getVhcChargeUtile():"",
                        "vhc_poids_vide" => $vehicule->getVhcPoidsVide()?(string)$vehicule->getVhcPoidsVide():"",
                        "vhc_poids_total_charge" => $vehicule->getVhcPoidsTotalCharge()?(string)$vehicule->getVhcPoidsTotalCharge():"",
                        "mrq_libelle" => $marque->getMrqLibelle()?(string)$marque->getMrqLibelle():"",
                        "gr_libelle" => $genre->getGrLibelle()?(string)$genre->getGrLibelle():"",
                        "vst_num_pv" => $visite->getVstNumPv()?(string)$visite->getVstNumPv():"",
                        "vst_date_expiration" => (string)$visite->getVstIsApte()=="1"?(string)$visite->getVstDateExpiration()->format('Y-m-d'):$visite->getVstDureeReparation(),
                        "vst_is_apte" => $visite->getVstIsApte()?(string)$visite->getVstIsApte():"0",
                        "vst_is_contre_visite" => $visite->getVstIsContreVisite()?(string)$visite->getVstIsContreVisite():"0",
                        "vst_created" => $visite->getVstCreated()?(string)$visite->getVstCreated()->format('Y-m-d H:m:s'):"",
                        "ctr_nom" => $centre->getCtrNom()?(string)$centre->getCtrNom():"",
                        "prv_nom" => $province->getPrvNom()?(string)$province->getPrvNom():"",
                        "usg_libelle" => $usage->getUsgLibelle()?(string)$usage->getUsgLibelle():"",
                        "nom_verificateur" => $verificateur?(string)$verificateur->getUsrName():"",
                        "usr_name" => $secretaire?(string)$secretaire->getUsrName():"",
                        "ut_libelle" => $utilisation->getUtLibelle()?(string)$utilisation->getUtLibelle():"",
                        "vst_anomalies" => $liste_anomalies?trim((string)$liste_anomalies):"",
                        "imprime" => $liste_imprime,
                    ];
                    $array_vehicule->add($info_vehicule);
                    //"vst_date_expiration" => $visite->getVstDateExpiration()?(string)$visite->getVstDateExpiration()->format('Y-m-d'):"",
                }
            }
            $response = new JsonResponse($array_vehicule->toArray());
            $response->headers->set('Access-Control-Allow-Headers', '*');
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
    
            return $response;
            //return new JsonResponse($array_vehicule->toArray());            
            //return new JsonResponse(['result' => 'ok', 'retour' => ['lien' => $arraysites->toArray()]]);
        } catch(\Exception $e) {
            return new JsonResponse($e);
        }
        /* return $this->render('ct_service_mobile/index.html.twig', [
            'controller_name' => 'CtServiceMobileController',
        ]); */
    }
}
