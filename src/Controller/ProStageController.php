<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

use App\Repository\StageRepository;
use App\Repository\FormationRepository;
use App\Repository\EntrepriseRepository;

class ProStageController extends AbstractController
{
    /**
     * @Route("/", name="pro_stage_accueil")
     */
    public function index(StageRepository $repositoryStage): Response
    {


        $stages=$repositoryStage->findAll();

        return $this->render('pro_stage/index.html.twig',['listeStages'=>$stages,
        ]);
    }

    /**
     * @Route("/stages/{idStage}", name="pro_stage_stages")
     */
    public function stages(Stage $stage): Response
    {
        return $this->render('pro_stage/stages.html.twig', ['stage'=>$stage
        ]);
    }


    
     /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function entreprises(EntrepriseRepository $repositoryEntreprise): Response
    {

        $entreprises=$repositoryEntreprise->findAll();

        return $this->render('pro_stage/entreprises.html.twig', ['listeEntreprises'=>$entreprises,
        ]);
    }

     /**
     * @Route("/entreprises/stages/{idEntreprise}", name="pro_stage_voir_stages_entreprise")
     */
    public function stagesDansEntreprises(Entreprise $entreprise ): Response
    {
        return $this->render('pro_stage/listeStagesEntreprise.html.twig', ['entreprise'=>$entreprise
        ]);
    }



    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function formations(FormationRepository $repositoryFormation): Response
    {
        $formations=$repositoryFormation->findAll();

        return $this->render('pro_stage/formations.html.twig',['listeFormations'=>$formations
        ]);
    }


    /**
     * @Route("/formations/stages/{idFormation}", name="pro_stage_voir_stages_formation")
     */
    public function stagesDansFormations(Formation $formation): Response
    {
        $formation=$repositoryFormation->find($idFormation);

        return $this->render('pro_stage/listeStagesFormation.html.twig', ['formation'=>$formation
        ]);
    }
	
    

}
