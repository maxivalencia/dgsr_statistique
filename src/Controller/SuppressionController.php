<?php

namespace App\Controller;

use App\Entity\CtVisite;
use App\Repository\CtVisiteRepository;
use App\Entity\CtVehicule;
use App\Repository\CtVehiculeRepository;
use App\Entity\CtReception;
use App\Repository\CtReceptionRepository;
use App\Entity\CtCarteGrise;
use App\Repository\CtCarteGriseRepository;
use App\Entity\CtConstAvDed;
use App\Repository\CtConstAvDedRepository;
use App\Entity\CtConstAvDedCarac;
use App\Repository\CtConstAvDedCaracRepository;
use App\Entity\CtConstAvDedsConstAvDedCaracs;
use App\Repository\CtConstAvDedsConstAvDedCaracsRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SuppressionController extends AbstractController
{
    /**
     * @Route("/", name="acceuil", methods={"GET","POST"})
     */
    public function Acceuil(Request $request): Response{
        return $this->render('suppression/acceuil.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }


    /**
     * @Route("/ct/suppression", name="suppression_erreur", methods={"GET", "POST"})
     */
    public function index(Request $request, CtVisiteRepository $ctVisiteRepository, CtReceptionRepository $ctReceptionRepository, CtConstAvDedRepository $ctConstAvDedRepository, CtCarteGriseRepository $ctCarteGriseRepository)
    {
        $numero = strtoupper(trim($request->query->get('numero')));
        $type_operation = $request->query->get('operation');
        $type_numero = $request->query->get('type');
        $motif = $request->query->get('motif');
        $flash = "";
        $typeflash = "success"; 
        if($numero == '' && $type_operation == '' && $type_numero == ''){
            $flash = ""; 
            $typeflash = "success";           
            return $this->render('suppression/index.html.twig', [
                'controller_name' => 'SuppressionController',
                'flash' => $flash,
                'typeflash' => $typeflash,
            ]);
        }
        if($numero == '' || $type_operation == '' || $type_numero == ''){
            $flash = "Erreur message - information nécessaire incomplète"; 
            $typeflash = "danger";           
            return $this->render('suppression/index.html.twig', [
                'controller_name' => 'SuppressionController',
                'flash' => $flash,
                'typeflash' => $typeflash,
            ]);
        }
        // raha numéro de PV no anaovana ilay suppression
        if ($type_numero == '0'){
            // raha visite ilay opération
            if($type_operation == '0'){
                //eto no manomboka ny opération
                $vst = new CtVisite();
                $vst = $ctVisiteRepository->findOneBy(['id' => intval($numero)]);
                if($vst == NULL){                    
                    $flash = "Erreur message - numéro PV inéxistant";  
                    $typeflash = "danger";          
                    return $this->render('suppression/index.html.twig', [
                        'controller_name' => 'SuppressionController',
                        'flash' => $flash,
                        'typeflash' => $typeflash,
                    ]);
                }
                $vst->setVstNumFeuilleCaisse($vst->getVstNumFeuilleCaisse().' '.$motif.' du '.$vst->getVstCreated()->format("Y-m-d H:m:s"));
                $vst->setVstCreated(new DateTime('1990-01-01 00:00:00'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($vst);
                $entityManager->flush();
                $flash = "Visite supprimer avec succès";
                $typeflash = "success";
            }
            // raha réception ilay opération
            if($type_operation == '1'){
                //eto no manomboka ny opération
                $rcp = new CtReception();
                $rcp = $ctReceptionRepository->findOneBy(['id' => intval($numero)]);
                if($rcp == NULL){                    
                    $flash = "Erreur message - numéro PV inéxistant";  
                    $typeflash = "danger";          
                    return $this->render('suppression/index.html.twig', [
                        'controller_name' => 'SuppressionController',
                        'flash' => $flash,
                        'typeflash' => $typeflash,
                    ]);
                }
                $rcp->setRcpImmatriculation($rcp->getRcpImmatriculation().'_'.$motif.' du '.$rcp->getRcpCreated()->format("Y-m-d H:m:s"));
                $rcp->setRcpCreated(new DateTime('1990-01-01 00:00:00'));
                $rcp->setRcpNumGroup($rcp->getRcpNumGroup().'_DELETED');
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($rcp);
                $entityManager->flush();
                $flash = "Réception supprimer avec succès";
                $typeflash = "success";
            }
            // raha constatation avant dédouanement ilay opération
            if($type_operation == '2'){
                //eto no manomboka ny opération
                $cad = new CtConstAvDed();
                $cad = $ctConstAvDedRepository->findOneBy(['id' => intval($numero)]);
                if($cad == NULL){                    
                    $flash = "Erreur message - numéro PV inéxistant";  
                    $typeflash = "danger";          
                    return $this->render('suppression/index.html.twig', [
                        'controller_name' => 'SuppressionController',
                        'flash' => $flash,
                        'typeflash' => $typeflash,
                    ]);
                }
                $cad->setCadImmatriculation($cad->getCadImmatriculation().'_'.$motif.' du '.$cad->getCadCreated()->format("Y-m-d H:m:s"));
                $cad->setCadCreated(new DateTime('1990-01-01 00:00:00'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cad);
                $entityManager->flush();
                $flash = "Constatation avant dédouanement supprimer avec succès";
                $typeflash = "success";
            }
        }

        // raha numéro d'immatriculation no anaovana ilay suppression
        if ($type_numero == '1'){
            // raha visite ilay opération
            if($type_operation == '0'){
                //eto no manomboka ny opération
                $ctg = new CtCarteGrise();
                $ctg = $ctCarteGriseRepository->findOneBy(['cgImmatriculation' => $numero]);
                if($ctg == NULL){                    
                    $flash = "Erreur message - numéro immatriculation inéxistant";  
                    $typeflash = "danger";          
                    return $this->render('suppression/index.html.twig', [
                        'controller_name' => 'SuppressionController',
                        'flash' => $flash,
                        'typeflash' => $typeflash,
                    ]);
                }              
                $vst = new CtVisite();
                $vst = $ctVisiteRepository->findOneBy(['ctCarteGrise' => $ctg], ["id" => "DESC"]);
                if($vst == NULL){                    
                    $flash = "Erreur message - numéro immatriculation sans visite";    
                    $typeflash = "danger";        
                    return $this->render('suppression/index.html.twig', [
                        'controller_name' => 'SuppressionController',
                        'flash' => $flash,
                        'typeflash' => $typeflash,
                    ]);
                }
                $vst->setVstNumFeuilleCaisse($vst->getVstNumFeuilleCaisse().' '.$motif.' du '.$vst->getVstCreated()->format("Y-m-d H:m:s"));
                $vst->setVstCreated(new DateTime('1990-01-01 00:00:00'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($vst);
                $entityManager->flush();
                $flash = "Visite supprimer avec succès";
                $typeflash = "success";
            }
            // raha réception ilay opération
            if($type_operation == '1'){
                //eto no manomboka ny opération
                $rcp = new CtReception();
                $rcp = $ctReceptionRepository->findOneBy(['rcpImmatriculation' => $numero]);
                if($rcp == NULL){                    
                    $flash = "Erreur message - numéro immatriculation inéxistant";   
                    $typeflash = "danger";         
                    return $this->render('suppression/index.html.twig', [
                        'controller_name' => 'SuppressionController',
                        'flash' => $flash,
                        'typeflash' => $typeflash,
                    ]);
                }
                $rcp->setRcpImmatriculation($rcp->getRcpImmatriculation().'_'.$motif.' du '.$rcp->getRcpCreated()->format("Y-m-d H:m:s"));
                $rcp->setRcpCreated(new DateTime('1990-01-01 00:00:00'));
                $rcp->setRcpNumGroup($rcp->getRcpNumGroup().'_DELETED');
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($rcp);
                $entityManager->flush();
                $flash = "Réception supprimer avec succès";
                $typeflash = "success";
            }
            // raha constatation avant dédouanement ilay opération
            if($type_operation == '2'){
                //eto no manomboka ny opération
                $cad = new CtConstAvDed();
                $cad = $ctConstAvDedRepository->findOneBy(['cadImmatriculation' => $numero]);
                if($cad == NULL){                    
                    $flash = "Erreur message - numéro immatriculation inéxistant";   
                    $typeflash = "danger" ;        
                    return $this->render('suppression/index.html.twig', [
                        'controller_name' => 'SuppressionController',
                        'flash' => $flash,
                        'typeflash' => $typeflash,
                    ]);
                }
                $cad->setCadImmatriculation($cad->getCadImmatriculation().'_'.$motif.' du '.$cad->getCadCreated()->format("Y-m-d H:m:s"));
                $cad->setCadCreated(new DateTime('1990-01-01 00:00:00'));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cad);
                $entityManager->flush();
                $flash = "Constatation avant dédouanement supprimer avec succès";
                $typeflash = "success";
            }
        }
        return $this->render('suppression/index.html.twig', [
            'controller_name' => 'SuppressionController',
            'flash' => $flash,
            'typeflash' => $typeflash,
        ]);
    }
}
