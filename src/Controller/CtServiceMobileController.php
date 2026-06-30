<?php

namespace App\Controller;


use App\Repository\CtCarteGriseRepository;
use App\Repository\CtVisiteRepository;
use App\Repository\CtVehiculeRepository;
use App\Repository\CtCarosserieRepository;
use App\Repository\CtSourceEnergieRepository;
use App\Repository\CtMarqueRepository;
use App\Repository\CtGenreRepository;
use App\Repository\CtMotifRepository;
use App\Repository\CtCentreRepository;
use App\Repository\CtProvinceRepository;
use App\Repository\CtUsageRepository;
use App\Repository\CtUserRepository;
use App\Repository\CtUtilisationRepository;
use App\Repository\CtVisiteAnomalieRepository;
use App\Repository\CtAnomalieRepository;
use App\Repository\CtImprimeTechUseRepository;
use App\Repository\CtImprimeTechRepository;
use App\Repository\CtReceptionRepository;
use App\Repository\CtConstAvDedRepository;
use App\Repository\CtConstAvDedsConstAvDedCaracsRepository;
use App\Repository\CtAvDedCaracRepository;
use App\Repository\CtAutreSceRepository;
use App\Repository\CtTypeAutreSceRepository;
use App\Repository\CtOptionVitreFumeeRepository;
use App\Repository\CtConstAvDedCarac;
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
    public function recherche(Request $request, CtTypeAutreSceRepository $ctTypeAutreSceRepository, CtOptionVitreFumeeRepository $ctOptionVitreFumeeRepository, CtAutreSceRepository $ctAutreSceRepository, CtMotifRepository $ctMotifRepository, CtAvDedCaracRepository $ctAvDedCaracRepository, CtConstAvDedsConstAvDedCaracsRepository $ctConstAvDedsConstAvDedCaracsRepository, CtConstAvDedRepository $ctConstAvDedRepository, CtReceptionRepository $ctReceptionRepository, CtImprimeTechUseRepository $ctImprimeTechUseRepository, CtAnomalieRepository $ctAnomalieRepository, CtVisiteAnomalieRepository $ctVisiteAnomalieRepository, CtUtilisationRepository $ctUtilisationRepository, CtUserRepository $ctUserRepository, CtUsageRepository $ctUsageRepository, CtProvinceRepository $ctProvinceRepository, CtCentreRepository $ctCentreRepository, CtVisiteRepository $ctVisiteRepository, CtGenreRepository $ctGenreRepository, CtMarqueRepository $ctMarqueRepository, CtSourceEnergieRepository $ctSourceEnergieRepository, CtCarteGriseRepository $ctCarteGriseRepository, CtVehiculeRepository $ctVehiculeRepository, CtCarosserieRepository $ctCarosserieRepository)
    {
        $array_vehicule = new ArrayCollection();
        $array_visite = new ArrayCollection();
        $array_reception = new ArrayCollection();
        $array_constatation = new ArrayCollection();
        $array_proprietaire = new ArrayCollection();
        $array_authenticite = new ArrayCollection();
        $array_carte_grise = new ArrayCollection();
        $array_resultat = new ArrayCollection();
        $reception_exist = 0;
        $visite_exist = 0;
        $constatation_exist = 0;
        $vehicule_exist = 0;
        $proprietaire_exist = 0;
        $authenticite_exist = 0;
        $carte_grise_id = 0;
        $numero_de_serie = "";
        $info_visite = [
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
        $info_reception = [
            "gr_libelle" => "",
            "rcp_num_pv" => "",
            "rcp_created" => "",
            "ctr_nom" => "",
            "prv_nom" => "",
            "usr_name" => "",
            "ut_libelle" => "",
            "mtf_libelle" => "",
            "imprime" => "",
        ];
        $info_constatation = [
            "ctr_nom" => "",
            "nom_verificateur" => "",
            "cad_provenance" => "",
            "cad_divers" => "",
            "cad_proprietaire_nom" => "",
            "cad_proprietaire_adresse" => "",
            "cad_bon_etat" => "",
            "cad_sec_pers" => "",
            "cad_sec_march" => "",
            "cad_protec_env" => "",
            "cad_numero" => "",
            "cad_immatriculation" => "",
            "cad_date_embarquement" => "",
            "cad_lieu_embarquement" => "",
            "cad_created" => "",
            "cad_conforme" => "",
            "cad_observation" => "",
            "imprime" => "",
        ];
        $info_proprietaire = [
            "cg_nom" => "",
            "cg_prenom" => "",
            "cg_phone" => "",
            "cg_profession" => "",
            "cg_nom_cooperative" => "",
            "cg_adresse" => "",
            "cg_commune" => "",
        ];
        $info_vehicule = [
            "mrq_libelle" => "",
            "gr_libelle" => "",
            "cg_immatriculation" => "",
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
            "vhc_puissance" => "",
        ];
        $info_authenticite = [
            "avf_num_pv" => "",
            "avf_date" => "",
            "avf_utilisation" => "",
            "avf_centre" => "",
            "avf_user" => "",
            "avf_verificateur" => "",
            "avf_option_vitre_fume" => "",
            "avf_validite" => "",
            "imprime" => "",
        ];
        $liste_carte_grise = [
            "carte_grise_id" => "",
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
        $immatriculation_reception = $immatriculation;
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
                if($carte_grise != null){
                    $carte_grise_id = $carte_grise->getId();
                    if(!$array_carte_grise->contains($carte_grise_id)){
                        $array_carte_grise->add($carte_grise_id);
                    }
                }
                if($carte_grise != null) {
                    $vehicule = $ctVehiculeRepository->findOneBy(["id" => $carte_grise->getCtVehicule()]);
                    $carosserie = $ctCarosserieRepository->findOneBy(["id" => $carte_grise->getCtCarosserie()]);
                    $source_energie = $ctSourceEnergieRepository->findOneBy(["id" => $carte_grise->getCtSourceEnergie()]);
                    $marque = $ctMarqueRepository->findOneBy(["id" => $vehicule->getCtMarque()]);
                    $genre = $ctGenreRepository->findOneBy(["id" => $vehicule->getCtGenre()]);
                    $visite = $ctVisiteRepository->findOneBy(["ctCarteGrise" => $carte_grise->getId()], ["vstCreated" => "DESC"]);
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
                    $imprimesAuthenticite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Authenticité"]);
                    $imprimesMutation = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Mutation"]);
                    $imprimesVenteSpeciale = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Vente spéciale"]);
                    $imprimesDuplicata = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Duplicata"]);
                    $imprimesSpeciale = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Spéciale"]);
                    $imprimesCaracteristique = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Caractéristique"]);
                    $imprimesDuplicataVisite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Duplicata visite"]);
                    $imprimesAutres = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Autres"]);
                    $imprimesVisiteTechniqueSpeciale = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Visite technique spéciale"]);
                    $imprimesDuplicataAuthenticite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Duplicata authenticité"]);
                    $imprimesMutationAuthenticite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Mutation authenticité"]);
                    $imprimesChangementOption = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Changement option"]);
                    $imprimes = array_merge($imprimesVisite, $imprimesContre, $imprimesAuthenticite, $imprimesMutation, $imprimesVenteSpeciale, $imprimesDuplicata, $imprimesSpeciale, $imprimesCaracteristique, $imprimesDuplicataVisite, $imprimesAutres, $imprimesVisiteTechniqueSpeciale, $imprimesDuplicataAuthenticite, $imprimesMutationAuthenticite, $imprimesChangementOption);
                    $numero_de_serie = $vehicule->getVhcNumSerie();
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
                        "mrq_libelle" => $marque->getMrqLibelle()?(string)$marque->getMrqLibelle():"",
                        "gr_libelle" => $genre->getGrLibelle()?(string)$genre->getGrLibelle():"",
                        "cg_immatriculation" => $carte_grise->getCgImmatriculation()?(string)$carte_grise->getCgImmatriculation():"",
                        "cg_puissance_admin" => $carte_grise->getCgPuissanceAdmin()?(string)$carte_grise->getCgPuissanceAdmin():"",
                        "cg_nbr_assis" => $carte_grise->getCgNbrAssis()?(string)$carte_grise->getCgNbrAssis():"",
                        "cg_nbr_debout" => $carte_grise->getCgNbrDebout()?(string)$carte_grise->getCgNbrDebout():"",
                        "cg_mise_en_service" => $carte_grise->getCgMiseEnService()?(string)$carte_grise->getCgMiseEnService()->format('Y-m-d'):"",
                        "cg_num_carte_violette" => $carte_grise->getCgNumCarteViolette()?(string)$carte_grise->getCgNumCarteViolette():"",
                        "cg_date_carte_violette" => $carte_grise->getCgDateCarteViolette()?(string)$carte_grise->getCgDateCarteViolette()->format('Y-m-d'):"",
                        "cg_patente" => $carte_grise->getCgPatente()?(string)$carte_grise->getCgPatente():"",
                        "cg_ani" => $carte_grise->getCgAni()?(string)$carte_grise->getCgAni():"",
                        "cg_num_vignette" => $carte_grise->getCgNumVignette()?(string)$carte_grise->getCgNumVignette():"",
                        "cg_date_vignette" => $carte_grise->getCgDateVignette()?(string)$carte_grise->getCgDateVignette()->format('Y-m-d'):"",
                        "crs_libelle" => $carosserie->getCrsLibelle()?(string)$carosserie->getCrsLibelle():"",
                        "sre_libelle" => $source_energie->getSreLibelle()?(string)$source_energie->getSreLibelle():"",
                        "vhc_num_serie" => $vehicule->getVhcNumSerie()?(string)$vehicule->getVhcNumSerie():"",
                        "vhc_num_moteur" => $vehicule->getVhcNumMoteur()?(string)$vehicule->getVhcNumMoteur():"",
                        "vhc_type" => $vehicule->getVhcType()?(string)$vehicule->getVhcType():"",
                        "vhc_charge_utile" => $vehicule->getVhcChargeUtile()?(string)$vehicule->getVhcChargeUtile():"",
                        "vhc_poids_vide" => $vehicule->getVhcPoidsVide()?(string)$vehicule->getVhcPoidsVide():"",
                        "vhc_poids_total_charge" => $vehicule->getVhcPoidsTotalCharge()?(string)$vehicule->getVhcPoidsTotalCharge():"",
                        "vhc_puissance" => $vehicule->getVhcPuissance()?(string)$vehicule->getVhcPuissance():"",
                    ];
                    $info_proprietaire = [
                        "cg_nom" => $carte_grise->getCgNom()?(string)$carte_grise->getCgNom():"",
                        "cg_prenom" => trim((string)$carte_grise->getCgPrenom()),
                        "cg_phone" => trim((string)$carte_grise->getCgPhone()),
                        "cg_profession" => $carte_grise->getCgProfession()?(string)$carte_grise->getCgProfession():"",
                        "cg_nom_cooperative" => $carte_grise->getCgNomCooperative()?(string)$carte_grise->getCgNomCooperative():"",
                        "cg_adresse" => $carte_grise->getCgAdresse()?(string)$carte_grise->getCgAdresse():"",
                        "cg_commune" => $carte_grise->getCgCommune()?(string)$carte_grise->getCgCommune():"",
                    ];
                    $info_visite = [
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
                    $vehicule_exist++;
                    $array_proprietaire->add($info_proprietaire);
                    $proprietaire_exist++;
                    $array_visite->add($info_visite);
                    $visite_exist++;
                    //"vst_date_expiration" => $visite->getVstDateExpiration()?(string)$visite->getVstDateExpiration()->format('Y-m-d'):"",
                }
            }
            foreach($separateurs as $separateur){
                $imm = $chiffre_immatriculation.$separateur.$lettre_immatriculation;
                $reception = $ctReceptionRepository->findOneBy(["rcpImmatriculation" => $imm], ["rcpCreated" => "DESC"]);
                if($reception != null) {
                    $vehicule_id = $reception->getCtVehicule();
                    if($vehicule_id != null){
                        $carte_grise_reception = $ctCarteGriseRepository->findOneBy(["ctVehicule" => $vehicule_id]);
                        if($carte_grise_reception != null){
                            $carte_grise_id = $carte_grise_reception->getId();
                            if(!$array_carte_grise->contains($carte_grise_id)){
                                $array_carte_grise->add($carte_grise_id);
                            }
                        }
                    }
                }
                if($reception != null) {
                    $vehicule = $ctVehiculeRepository->findOneBy(["id" => $reception->getCtVehicule()]);
                    $carosserie = $ctCarosserieRepository->findOneBy(["id" => $reception->getCtCarosserie()]);
                    $source_energie = $ctSourceEnergieRepository->findOneBy(["id" => $reception->getCtSourceEnergie()]);
                    $marque = $ctMarqueRepository->findOneBy(["id" => $vehicule->getCtMarque()]);
                    $genre = $ctGenreRepository->findOneBy(["id" => $vehicule->getCtGenre()]);
                    $motif = $ctMotifRepository->findOneBy(["id" => $reception->getCtMotif()]);
                    // $recep = $ctVisiteRepository->findOneBy(["ctCarteGrise" => $reception->getId()], ["vstCreated" => "DESC"]);
                    $centre = $ctCentreRepository->findOneBy(["id" => $reception->getCtCentre()]);
                    $province = $ctProvinceRepository->findOneBy(["id" => $centre->getCtProvince()]);
                    // $usage = $ctUsageRepository->findOneBy(["id" => $visite->getCtUsage()]);
                    // $verificateur = $ctUserRepository->findOneBy(["id" => $visite->getCtVerificateur()]);
                    $secretaire = $ctUserRepository->findOneBy(["id" => $reception->getCtUser()]);
                    $utilisation = $ctUtilisationRepository->findOneBy(["id" => $reception->getCtUtilisation()]);
                    $liste_anomalies = "";
                    $liste_imprime = "";
                    $imprimesReception = $ctImprimeTechUseRepository->findBy(["ctControleId" => $reception->getId(), "ituMotifUsed" => "Réception"]);
                    $imprimesDuplicataReception = $ctImprimeTechUseRepository->findBy(["ctControleId" => $reception->getId(), "ituMotifUsed" => "Duplicata réception"]);
                    $imprimes = array_merge($imprimesReception, $imprimesDuplicataReception);
                    if($numero_de_serie == ""){
                        $numero_de_serie = $vehicule->getVhcNumSerie();
                    }
                    // $imprimesVisite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Visite"]);
                    // $imprimesContre = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Contre"]);
                    // $imprimes = array_merge($imprimesVisite, $imprimesContre);
                    foreach($imprimes as $imp){
                        if($liste_imprime != ""){
                            $liste_imprime .= " - ";
                        }
                        $liste_imprime .= $imp->getCtImprimeTech()->getAbrevImprimeTech() . " : " . $imp->getItuNumero();
                    }
                    $info_vehicule = [
                        "mrq_libelle" => $marque->getMrqLibelle()?(string)$marque->getMrqLibelle():"",
                        "gr_libelle" => $genre->getGrLibelle()?(string)$genre->getGrLibelle():"",
                        "cg_immatriculation" => $reception->getRcpImmatriculation()?(string)$reception->getRcpImmatriculation():"",
                        "cg_nbr_assis" => $reception->getRcpNbrAssis()?(string)$reception->getRcpNbrAssis():"",
                        "cg_nbr_debout" => $reception->getRcpNbrDebout()?(string)$reception->getRcpNbrDebout():"",
                        "cg_mise_en_service" => $reception->getRcpMiseService()?(string)$reception->getRcpMiseService()->format('Y-m-d'):"",
                        "crs_libelle" => $carosserie->getCrsLibelle()?(string)$carosserie->getCrsLibelle():"",
                        "sre_libelle" => $source_energie->getSreLibelle()?(string)$source_energie->getSreLibelle():"",
                        "vhc_num_serie" => $vehicule->getVhcNumSerie()?(string)$vehicule->getVhcNumSerie():"",
                        "vhc_num_moteur" => $vehicule->getVhcNumMoteur()?(string)$vehicule->getVhcNumMoteur():"",
                        "vhc_type" => $vehicule->getVhcType()?(string)$vehicule->getVhcType():"",
                        "vhc_charge_utile" => $vehicule->getVhcChargeUtile()?(string)$vehicule->getVhcChargeUtile():"",
                        "vhc_poids_vide" => $vehicule->getVhcPoidsVide()?(string)$vehicule->getVhcPoidsVide():"",
                        "vhc_poids_total_charge" => $vehicule->getVhcPoidsTotalCharge()?(string)$vehicule->getVhcPoidsTotalCharge():"",
                        "vhc_puissance" => $vehicule->getVhcPuissance()?(string)$vehicule->getVhcPuissance():"",
                    ];
                    $info_proprietaire = [
                        // "cg_immatriculation" => $reception->getRcpImmatriculation()?(string)$reception->getRcpImmatriculation():"",
                        "cg_nom" => $reception->getRcpProprietaire()?(string)$reception->getRcpProprietaire():"",
                        "cg_profession" => $reception->getRcpProfession()?(string)$reception->getRcpProfession():"",
                        "cg_adresse" => $reception->getRcpAdresse()?(string)$reception->getRcpAdresse():"",
                    ];
                    $info_reception = [
                        "rcp_num_pv" => $reception->getRcpNumPv()?(string)$reception->getRcpNumPv():"",
                        "rcp_created" => $reception->getRcpCreated()?(string)$reception->getRcpCreated()->format('Y-m-d H:m:s'):"",
                        "ctr_nom" => $centre->getCtrNom()?(string)$centre->getCtrNom():"",
                        "prv_nom" => $province->getPrvNom()?(string)$province->getPrvNom():"",
                        "usr_name" => $secretaire?(string)$secretaire->getUsrName():"",
                        "ut_libelle" => $utilisation->getUtLibelle()?(string)$utilisation->getUtLibelle():"",
                        "mtf_libelle" => $motif->getMtfLibelle()?(string)$motif->getMtfLibelle():"",
                        "imprime" => $liste_imprime,
                    ];
                    if($vehicule_exist <= 0) {
                        $array_vehicule->add($info_vehicule);
                        $vehicule_exist++;
                    }
                    if($proprietaire_exist <= 0) {
                        $array_proprietaire->add($info_proprietaire);
                        $proprietaire_exist++;
                    }
                    $array_reception->add($info_reception);
                    $reception_exist++;
                }
            }
            if($immatriculation_reception != null && $reception_exist <= 0) {
                $reception = $ctReceptionRepository->findOneBy(["rcpImmatriculation" => $immatriculation_reception], ["rcpCreated" => "DESC"]);
                if($reception != null) {
                    $vehicule_id = $reception->getCtVehicule();
                    if($vehicule_id != null){
                        $carte_grise_reception = $ctCarteGriseRepository->findOneBy(["ctVehicule" => $vehicule_id]);
                        if($carte_grise_reception != null){
                            $carte_grise_id = $carte_grise_reception->getId();
                            if(!$array_carte_grise->contains($carte_grise_id)){
                                $array_carte_grise->add($carte_grise_id);
                            }
                        }
                    }
                }
                if($reception != null){
                    $vehicule = $ctVehiculeRepository->findOneBy(["id" => $reception->getCtVehicule()]);
                    $carosserie = $ctCarosserieRepository->findOneBy(["id" => $reception->getCtCarosserie()]);
                    $source_energie = $ctSourceEnergieRepository->findOneBy(["id" => $reception->getCtSourceEnergie()]);
                    $marque = $ctMarqueRepository->findOneBy(["id" => $vehicule->getCtMarque()]);
                    $genre = $ctGenreRepository->findOneBy(["id" => $vehicule->getCtGenre()]);
                    $motif = $ctMotifRepository->findOneBy(["id" => $reception->getCtMotif()]);
                    // $recep = $ctVisiteRepository->findOneBy(["ctCarteGrise" => $reception->getId()], ["vstCreated" => "DESC"]);
                    $centre = $ctCentreRepository->findOneBy(["id" => $reception->getCtCentre()]);
                    $province = $ctProvinceRepository->findOneBy(["id" => $centre->getCtProvince()]);
                    // $usage = $ctUsageRepository->findOneBy(["id" => $visite->getCtUsage()]);
                    // $verificateur = $ctUserRepository->findOneBy(["id" => $visite->getCtVerificateur()]);
                    $secretaire = $ctUserRepository->findOneBy(["id" => $reception->getCtUser()]);
                    $utilisation = $ctUtilisationRepository->findOneBy(["id" => $reception->getCtUtilisation()]);
                    $liste_anomalies = "";
                    $liste_imprime = "";
                    $imprimesReception = $ctImprimeTechUseRepository->findBy(["ctControleId" => $reception->getId(), "ituMotifUsed" => "Réception"]);
                    $imprimesDuplicataReception = $ctImprimeTechUseRepository->findBy(["ctControleId" => $reception->getId(), "ituMotifUsed" => "Duplicata réception"]);
                    $imprimes = array_merge($imprimesReception, $imprimesDuplicataReception);
                    if($numero_de_serie == ""){
                        $numero_de_serie = $vehicule->getVhcNumSerie();
                    }
                    // $imprimesVisite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Visite"]);
                    // $imprimesContre = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Contre"]);
                    // $imprimes = array_merge($imprimesVisite, $imprimesContre);
                    foreach($imprimes as $imp){
                        if($liste_imprime != ""){
                            $liste_imprime .= " - ";
                        }
                        $liste_imprime .= $imp->getCtImprimeTech()->getAbrevImprimeTech() . " : " . $imp->getItuNumero();
                    }
                    $info_vehicule = [
                        "mrq_libelle" => $marque->getMrqLibelle()?(string)$marque->getMrqLibelle():"",
                        "gr_libelle" => $genre->getGrLibelle()?(string)$genre->getGrLibelle():"",
                        "cg_immatriculation" => $reception->getRcpImmatriculation()?(string)$reception->getRcpImmatriculation():"",
                        "cg_nbr_assis" => $reception->getRcpNbrAssis()?(string)$reception->getRcpNbrAssis():"",
                        "cg_nbr_debout" => $reception->getRcpNbrDebout()?(string)$reception->getRcpNbrDebout():"",
                        "cg_mise_en_service" => $reception->getRcpMiseService()?(string)$reception->getRcpMiseService()->format('Y-m-d'):"",
                        "crs_libelle" => $carosserie->getCrsLibelle()?(string)$carosserie->getCrsLibelle():"",
                        "sre_libelle" => $source_energie->getSreLibelle()?(string)$source_energie->getSreLibelle():"",
                        "vhc_num_serie" => $vehicule->getVhcNumSerie()?(string)$vehicule->getVhcNumSerie():"",
                        "vhc_num_moteur" => $vehicule->getVhcNumMoteur()?(string)$vehicule->getVhcNumMoteur():"",
                        "vhc_type" => $vehicule->getVhcType()?(string)$vehicule->getVhcType():"",
                        "vhc_charge_utile" => $vehicule->getVhcChargeUtile()?(string)$vehicule->getVhcChargeUtile():"",
                        "vhc_poids_vide" => $vehicule->getVhcPoidsVide()?(string)$vehicule->getVhcPoidsVide():"",
                        "vhc_poids_total_charge" => $vehicule->getVhcPoidsTotalCharge()?(string)$vehicule->getVhcPoidsTotalCharge():"",
                        "vhc_puissance" => $vehicule->getVhcPuissance()?(string)$vehicule->getVhcPuissance():"",
                    ];
                    $info_proprietaire = [
                        // "cg_immatriculation" => $reception->getRcpImmatriculation()?(string)$reception->getRcpImmatriculation():"",
                        "cg_nom" => $reception->getRcpProprietaire()?(string)$reception->getRcpProprietaire():"",
                        "cg_profession" => $reception->getRcpProfession()?(string)$reception->getRcpProfession():"",
                        "cg_adresse" => $reception->getRcpAdresse()?(string)$reception->getRcpAdresse():"",
                    ];
                    $info_reception = [
                        "rcp_num_pv" => $reception->getRcpNumPv()?(string)$reception->getRcpNumPv():"",
                        "rcp_created" => $reception->getRcpCreated()?(string)$reception->getRcpCreated()->format('Y-m-d H:m:s'):"",
                        "ctr_nom" => $centre->getCtrNom()?(string)$centre->getCtrNom():"",
                        "prv_nom" => $province->getPrvNom()?(string)$province->getPrvNom():"",
                        "usr_name" => $secretaire?(string)$secretaire->getUsrName():"",
                        "ut_libelle" => $utilisation->getUtLibelle()?(string)$utilisation->getUtLibelle():"",
                        "mtf_libelle" => $motif->getMtfLibelle()?(string)$motif->getMtfLibelle():"",
                        "imprime" => $liste_imprime,
                    ];
                    if($vehicule_exist <= 0) {
                        $array_vehicule->add($info_vehicule);
                        $vehicule_exist++;
                    }
                    if($proprietaire_exist <= 0) {
                        $array_proprietaire->add($info_proprietaire);
                        $proprietaire_exist++;
                    }
                    $array_reception->add($info_reception);
                    $reception_exist++;
                }
            }
            // reception par numéro de série de visite
            if($reception_exist <= 0 && $numero_de_serie != "") {
                $vehicule = $ctVehiculeRepository->findOneBy(["vhcNumSerie" => $numero_de_serie]);
                $reception = $ctReceptionRepository->findOneBy(["ctVehicule" => $vehicule], ["rcpCreated" => "DESC"]);
                    if($reception != null) {
                    $vehicule_id = $reception->getCtVehicule();
                    if($vehicule_id != null){
                        $carte_grise_reception = $ctCarteGriseRepository->findOneBy(["ctVehicule" => $vehicule_id]);
                        if($carte_grise_reception != null){
                            $carte_grise_id = $carte_grise_reception->getId();
                            if(!$array_carte_grise->contains($carte_grise_id)){
                                $array_carte_grise->add($carte_grise_id);
                            }
                        }
                    }
                }
                if($reception != null){
                    $vehicule = $ctVehiculeRepository->findOneBy(["id" => $reception->getCtVehicule()]);
                    $carosserie = $ctCarosserieRepository->findOneBy(["id" => $reception->getCtCarosserie()]);
                    $source_energie = $ctSourceEnergieRepository->findOneBy(["id" => $reception->getCtSourceEnergie()]);
                    $marque = $ctMarqueRepository->findOneBy(["id" => $vehicule->getCtMarque()]);
                    $genre = $ctGenreRepository->findOneBy(["id" => $vehicule->getCtGenre()]);
                    $motif = $ctMotifRepository->findOneBy(["id" => $reception->getCtMotif()]);
                    // $recep = $ctVisiteRepository->findOneBy(["ctCarteGrise" => $reception->getId()], ["vstCreated" => "DESC"]);
                    $centre = $ctCentreRepository->findOneBy(["id" => $reception->getCtCentre()]);
                    $province = $ctProvinceRepository->findOneBy(["id" => $centre->getCtProvince()]);
                    // $usage = $ctUsageRepository->findOneBy(["id" => $visite->getCtUsage()]);
                    // $verificateur = $ctUserRepository->findOneBy(["id" => $visite->getCtVerificateur()]);
                    $secretaire = $ctUserRepository->findOneBy(["id" => $reception->getCtUser()]);
                    $utilisation = $ctUtilisationRepository->findOneBy(["id" => $reception->getCtUtilisation()]);
                    $liste_anomalies = "";
                    $liste_imprime = "";
                    $imprimesReception = $ctImprimeTechUseRepository->findBy(["ctControleId" => $reception->getId(), "ituMotifUsed" => "Réception"]);
                    $imprimesDuplicataReception = $ctImprimeTechUseRepository->findBy(["ctControleId" => $reception->getId(), "ituMotifUsed" => "Duplicata réception"]);
                    $imprimes = array_merge($imprimesReception, $imprimesDuplicataReception);
                    if($numero_de_serie == ""){
                        $numero_de_serie = $vehicule->getVhcNumSerie();
                    }
                    // $imprimesVisite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Visite"]);
                    // $imprimesContre = $ctImprimeTechUseRepository->findBy(["ctControleId" => $visite->getId(), "ituMotifUsed" => "Contre"]);
                    // $imprimes = array_merge($imprimesVisite, $imprimesContre);
                    foreach($imprimes as $imp){
                        if($liste_imprime != ""){
                            $liste_imprime .= " - ";
                        }
                        $liste_imprime .= $imp->getCtImprimeTech()->getAbrevImprimeTech() . " : " . $imp->getItuNumero();
                    }
                    $info_vehicule = [
                        "mrq_libelle" => $marque->getMrqLibelle()?(string)$marque->getMrqLibelle():"",
                        "gr_libelle" => $genre->getGrLibelle()?(string)$genre->getGrLibelle():"",
                        "cg_immatriculation" => $reception->getRcpImmatriculation()?(string)$reception->getRcpImmatriculation():"",
                        "cg_nbr_assis" => $reception->getRcpNbrAssis()?(string)$reception->getRcpNbrAssis():"",
                        "cg_nbr_debout" => $reception->getRcpNbrDebout()?(string)$reception->getRcpNbrDebout():"",
                        "cg_mise_en_service" => $reception->getRcpMiseService()?(string)$reception->getRcpMiseService()->format('Y-m-d'):"",
                        "crs_libelle" => $carosserie->getCrsLibelle()?(string)$carosserie->getCrsLibelle():"",
                        "sre_libelle" => $source_energie->getSreLibelle()?(string)$source_energie->getSreLibelle():"",
                        "vhc_num_serie" => $vehicule->getVhcNumSerie()?(string)$vehicule->getVhcNumSerie():"",
                        "vhc_num_moteur" => $vehicule->getVhcNumMoteur()?(string)$vehicule->getVhcNumMoteur():"",
                        "vhc_type" => $vehicule->getVhcType()?(string)$vehicule->getVhcType():"",
                        "vhc_charge_utile" => $vehicule->getVhcChargeUtile()?(string)$vehicule->getVhcChargeUtile():"",
                        "vhc_poids_vide" => $vehicule->getVhcPoidsVide()?(string)$vehicule->getVhcPoidsVide():"",
                        "vhc_poids_total_charge" => $vehicule->getVhcPoidsTotalCharge()?(string)$vehicule->getVhcPoidsTotalCharge():"",
                        "vhc_puissance" => $vehicule->getVhcPuissance()?$vehicule->getVhcPuissance():"",
                    ];
                    $info_proprietaire = [
                        // "cg_immatriculation" => $reception->getRcpImmatriculation()?(string)$reception->getRcpImmatriculation():"",
                        "cg_nom" => $reception->getRcpProprietaire()?(string)$reception->getRcpProprietaire():"",
                        "cg_profession" => $reception->getRcpProfession()?(string)$reception->getRcpProfession():"",
                        "cg_adresse" => $reception->getRcpAdresse()?(string)$reception->getRcpAdresse():"",
                    ];
                    $info_reception = [
                        "rcp_num_pv" => $reception->getRcpNumPv()?(string)$reception->getRcpNumPv():"",
                        "rcp_created" => $reception->getRcpCreated()?(string)$reception->getRcpCreated()->format('Y-m-d H:m:s'):"",
                        "ctr_nom" => $centre->getCtrNom()?(string)$centre->getCtrNom():"",
                        "prv_nom" => $province->getPrvNom()?(string)$province->getPrvNom():"",
                        "usr_name" => $secretaire?(string)$secretaire->getUsrName():"",
                        "ut_libelle" => $utilisation->getUtLibelle()?(string)$utilisation->getUtLibelle():"",
                        "mtf_libelle" => $motif->getMtfLibelle()?(string)$motif->getMtfLibelle():"",
                        "imprime" => $liste_imprime,
                    ];
                    if($vehicule_exist <= 0) {
                        $array_vehicule->add($info_vehicule);
                        $vehicule_exist++;
                    }
                    if($proprietaire_exist <= 0) {
                        $array_proprietaire->add($info_proprietaire);
                        $proprietaire_exist++;
                    }
                    $array_reception->add($info_reception);
                    $reception_exist++;
                }
            }
            // recherche pour constatation
            if($numero_de_serie != ""){
                $constatation_caracteristique = $ctAvDedCaracRepository->findOneBy(["cadNumSerieType" => $numero_de_serie], ["id" => "DESC"]);
                if($constatation_caracteristique != null){
                    $constatation_caracteristique_id = $constatation_caracteristique->getId();
                    $constatation_avant_dedouanement_constatation_caracteristique = $ctConstAvDedsConstAvDedCaracsRepository->findOneBy(["const_av_ded_carac_id" => $constatation_caracteristique_id]);
                    $constatation = $ctConstAvDedRepository->findOneBy(["id" => $constatation_avant_dedouanement_constatation_caracteristique->getConstAvDedId()]);
                    // $constatation = $ctConstAvDedRepository->findOneBy(["id" => $constatation_id]);
                    $imprimes = $ctImprimeTechUseRepository->findBy(["ctControleId" => $constatation->getId(), "ituMotifUsed" => "Constatation"]);
                    $genre = $ctGenreRepository->findOneBy(["id" => $constatation_caracteristique->getCtGenre()]);
                    $marque = $ctMarqueRepository->findOneBy(["id" => $constatation_caracteristique->getCtMarque()]);
                    $liste_imprime = "";
                    foreach($imprimes as $imp){
                        if($liste_imprime != ""){
                            $liste_imprime .= " - ";
                        }
                        $liste_imprime .= $imp->getCtImprimeTech()->getAbrevImprimeTech() . " : " . $imp->getItuNumero();
                    }
                    $info_constatation = [
                        "ctr_nom" => $constatation->getCtCentre()->getCtrNom()?(string)$constatation->getCtCentre()->getCtrNom():"",
                        "nom_verificateur" => $constatation->getCtVerificateur()->getUsrName()?(string)$constatation->getCtVerificateur()->getUsrName():"",
                        "cad_provenance" => $constatation->getCadProvenance()?(string)$constatation->getCadProvenance():"",
                        "cad_divers" => $constatation->getCadDivers()?(string)$constatation->getCadDivers():"",
                        "cad_proprietaire_nom" => $constatation->getCadProprietaireNom()?(string)$constatation->getCadProprietaireNom():"",
                        "cad_proprietaire_adresse" => $constatation->getCadProprietaireAdresse()?(string)$constatation->getCadProprietaireAdresse():"",
                        "cad_bon_etat" => $constatation->getCadBonEtat()?(string)$constatation->getCadBonEtat():"",
                        "cad_sec_pers" => $constatation->getCadSecPers()?(string)$constatation->getCadSecPers():"",
                        "cad_sec_march" => $constatation->getCadSecMarch()?(string)$constatation->getCadSecMarch():"",
                        "cad_protec_env" => $constatation->getCadProtecEnv()?(string)$constatation->getCadProtecEnv():"",
                        "cad_numero" => $constatation->getCadNumero()?(string)$constatation->getCadNumero():"",
                        "cad_immatriculation" => $constatation->getCadImmatriculation()?(string)$constatation->getCadImmatriculation():"",
                        "cad_date_embarquement" => $constatation->getCadDateEmbarquement()?(string)$constatation->getCadDateEmbarquement()->format('Y-m-d H:m:s'):"",
                        "cad_lieu_embarquement" => $constatation->getCadLieuEmbarquement()?(string)$constatation->getCadLieuEmbarquement():"",
                        "cad_created" => $constatation->getCadCreated()?(string)$constatation->getCadCreated()->format('Y-m-d H:m:s'):"",
                        "cad_conforme" => $constatation->getCadConforme()?(string)$constatation->getCadConforme():"",
                        "cad_observation" => $constatation->getCadObservation()?(string)$constatation->getCadObservation():"",
                        "cat_puissance" =>$constatation_caracteristique->getCadPuissance()?(string)$constatation_caracteristique->getCadPuissance():"",
                        "mrq_libelle" => $marque->getMrqLibelle()?(string)$marque->getMrqLibelle():"",
                        "gr_libelle" => $genre->getGrLibelle()?(string)$genre->getGrLibelle():"",
                        "imprime" => $liste_imprime,
                    ];
                    $array_constatation->add($info_constatation);
                    $constatation_exist++;
                }
            }
            // pour l'authenticité vitre fumée
            foreach($array_carte_grise as $carte_grise){
                $option_authenticite = [
                    $ctTypeAutreSceRepository->findOneBy(["id" => 1]),
                    $ctTypeAutreSceRepository->findOneBy(["id" => 6]),
                    $ctTypeAutreSceRepository->findOneBy(["id" => 7]),
                    $ctTypeAutreSceRepository->findOneBy(["id" => 10]),
                ];
                $authenticite = $ctAutreSceRepository->findOneBy(["ctCarteGrise" => $carte_grise, "ctTypeAutreSce" => $option_authenticite]);
                $utilisation = $authenticite->getCtUtilisation();
                $centre = $authenticite->getCtCentre();
                $user = $authenticite->getCtUser();
                $verificateur = $authenticite->getCtVerificateur();
                $option_vitre_fume = $authenticite->getCtOptionVitreFumee();
                $validite_vitre_fume = $authenticite->getAsValiditeFumee();
                $ituMotifUsed = [
                    "Authenticité",
                    "Duplicata authenticité",
                    "Mutation authenticité",
                ];
                $liste_imprime = "";
                    $imprimesAuthenticite = $ctImprimeTechUseRepository->findBy(["ctControleId" => $authenticite->getId(), "ituMotifUsed" => $ituMotifUsed]);
                    foreach($imprimesAuthenticite as $imp){
                        if($liste_imprime != ""){
                            $liste_imprime .= " - ";
                        }
                        $liste_imprime .= $imp->getCtImprimeTech()->getAbrevImprimeTech() . " : " . $imp->getItuNumero();
                    }
                if($authenticite != null){
                    $info_authenticite = [
                        "avf_num_pv" => $authenticite->getAsNumPv()?$authenticite->getAsNumPv():"",
                        "avf_date" => $authenticite->getAsDate()?$authenticite->getAsDate()->format('Y-m-d H:m:s'):"",
                        "avf_utilisation" => $utilisation->getUtLibelle()?$utilisation->getUtLibelle():"",
                        "avf_centre" => $centre->getCtrNom()?$centre->getCtrNom():"",
                        "avf_user" => $user->getUsrName()?$user->getUsrName():"",
                        "avf_verificateur" => $verificateur->getUsrName()?$verificateur->getUsrName():"",
                        "avf_option_vitre_fume" => $option_vitre_fume->getOvfLibelle()?$option_vitre_fume->getOvfLibelle():"",
                        "avf_validite" => $validite_vitre_fume?$validite_vitre_fume:"",
                        "imprime" => $liste_imprime,
                    ];
                    $array_authenticite->add($info_authenticite);
                    $authenticite_exist++;
                }
            }
            $resultat = [
                "Visite" => $array_visite->toArray(),
                "Reception" => $array_reception->toArray(),
                "Constatation" => $array_constatation->toArray(),
                "Vehicule" => $array_vehicule->toArray(),
                "Proprietaire" => $array_proprietaire->toArray(),
                "Authenticite" => $array_authenticite->toArray(),
            ];
            $array_resultat->add($resultat);
            // $response = new JsonResponse($array_vehicule->toArray());
            $response = new JsonResponse($array_resultat->toArray());
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
