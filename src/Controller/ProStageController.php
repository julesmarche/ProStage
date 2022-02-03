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
    /*
    public function index(StageRepository $repositoryStage) 
    {
        $stages=$repositoryStage->findAll();

        return $this->render('pro_stage/index.html.twig',['listeStages'=>$stages
        ]);
    }*/

    /**
     * @Route("/", name="pro_stage_accueil")
     */
    public function index(StageRepository $repositoryStage) 
    {
        $stages=$repositoryStage->recupererToutLesStages();

        return $this->render('pro_stage/index.html.twig',['listeStages'=>$stages
        ]);
    }

    /**
     * @Route("/stages/{id}", name="pro_stage_stages")
     */
    /*
    public function stages(Stage $stage)
    {
        return $this->render('pro_stage/descriptionStage.html.twig', ['stage' => $stage
        ]);
    }
    */

    /**
     * @Route("/stages/{idStage}", name="pro_stage_stages")
     */
    
    public function stages(StageRepository $repositoryStage , $idStage)
    {
        $stage = $repositoryStage->recupererInformationsStage($idStage);

        return $this->render('pro_stage/descriptionStage.html.twig', ['stage' => $stage,'idStage' => $idStage
        ]);
    }

 
     /**
     * @Route("/entreprises", name="pro_stage_entreprises")
     */
    public function entreprises(EntrepriseRepository $repositoryEntreprise)
    {
        $entreprises=$repositoryEntreprise->findAll();

        return $this->render('pro_stage/entreprises.html.twig', ['listeEntreprises' => $entreprises
        ]);
    }

    /*
        Ancienne fonction sans QueryBuilder
     /**
     * @Route("/entreprises/stages/{id}", name="pro_stage_voir_stages_entreprise")
     */
    /*
    public function stagesDansEntreprises(Entreprise $entreprise)
    {
        return $this->render('pro_stage/listeStagesEntreprise.html.twig', ['entreprise' => $entreprise
        ]);
    }
    */


     /**
     * @Route("/entreprises/stages/{nomEntreprise}", name="pro_stage_voir_stages_entreprise")
     */
    
    public function stagesDansEntreprises(StageRepository $repository, $nomEntreprise)
    {
        $stages = $repository->findStagesParEntreprise($nomEntreprise);

        return $this->render('pro_stage/listeStagesEntreprise.html.twig', ['stagesEntreprise' => $stages,'nom'=>$nomEntreprise
        ]);
    }

    



    /**
     * @Route("/formations", name="pro_stage_formations")
     */
    public function formations(FormationRepository $repositoryFormation)
    {
        $formations=$repositoryFormation->findAll();

        return $this->render('pro_stage/formations.html.twig',['listeFormations' => $formations
        ]);
    }


    /*
    /**
     * @Route("/formations/stages/{id}", name="pro_stage_voir_stages_formation")
     */
    /*
    public function stagesDansFormations(Formation $formation)
    {
        return $this->render('pro_stage/listeStagesFormation.html.twig', ['formation'=>$formation
        ]);
    }
    */


    /**
     * @Route("/formations/stages/{nomFormation}", name="pro_stage_voir_stages_formation")
     */

    public function stagesDansFormations(StageRepository $repository , $nomFormation)
    {
        $stages = $repository->findStagesParFormation($nomFormation);

        return $this->render('pro_stage/listeStagesFormation.html.twig', ['stagesFormation'=>$stages,'nomCourt'=>$nomFormation
        ]);
    }
	
    

}
