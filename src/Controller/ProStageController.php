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
     * @Route("/formations", name="pro_stage_formations")
     */
    public function formations(): Response
    {
        $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);

        $formations=$repositoryFormation->findAll();

        return $this->render('pro_stage/formations.html.twig',['listeFormations'=>$formations,//'controller_name' =>'Oui'
        ]);
    }
	
	/**
     * @Route("/stages/{id}", name="pro_stage_stages")
     */
    public function stages($id): Response
    {
        return $this->render('pro_stage/stages.html.twig', 
		['id_stages' => $id]);
    }
    

}
