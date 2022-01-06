<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage_accueil")
     */
    public function index(): Response
    {

        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);

        $stages=$repositoryStage->findAll();

        return $this->render('pro_stage/index.html.twig',['listeStages'=>$stages,//'controller_name' =>'Oui'
        ]);
    }
    
     /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function entreprises(): Response
    {

        $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);

        $entreprises=$repositoryEntreprise->findAll();

        return $this->render('pro_stage/entreprises.html.twig', ['listeEntreprises'=>$entreprises, //'controller_name' =>'Oui'
        ]);
    }

     /**
     * @Route("/entreprises/stages/{idEntreprise}", name="pro_stage_voir_stages_entreprise")
     */
    public function stagesDansEntreprises($idEntreprise): Response
    {

        $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);

        $entreprise=$repositoryEntreprise->find($idEntreprise);

        return $this->render('pro_stage/listeStagesEntreprise.html.twig', ['entreprise'=>$entreprise
        ]);
    }



    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function formations(): Response
    {
        $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);

        $formations=$repositoryFormation->findAll();

        return $this->render('pro_stage/formations.html.twig',['listeFormations'=>$formations
        ]);
    }


    /**
     * @Route("/formations/stages/{idFormation}", name="pro_stage_voir_stages_formation")
     */
    public function stagesDansFormations($idFormation): Response
    {

        $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);

        $formation=$repositoryFormation->find($idFormation);

        return $this->render('pro_stage/listeStagesFormation.html.twig', ['formation'=>$formation
        ]);
    }
	
	/**
     * @Route("/stages/{idStage}", name="pro_stage_stages")
     */
    public function stages($idStage): Response
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);

        $stage=$repositoryStage->find($idStage);

        return $this->render('pro_stage/stages.html.twig', ['stage'=>$stage
        ]);
    }
    

}
