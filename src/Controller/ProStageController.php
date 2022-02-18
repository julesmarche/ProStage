<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

use App\Repository\StageRepository;
use App\Repository\FormationRepository;
use App\Repository\EntrepriseRepository;

use App\Form\EntrepriseType;
use App\Form\StageType;




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
     * @Route("/ajoutStagesEnBd", name="pro_stage_ajoutStagesEnBd")
     */
    public function ajoutStagesEnBd(Request $requeteHttp, EntityManagerInterface $manager) 
    {
        $stage = new Stage();

        $formulaireStage = $this->createForm(StageType::class,$stage);

        $formulaireStage -> handleRequest ( $requeteHttp );


        if($formulaireStage->isSubmitted()&&$formulaireStage->isValid())
        {
            $manager->persist($stage);
            $manager->persist($stage->getEntreprise());
            $manager->flush();

            return $this->redirectToRoute('pro_stage_accueil');
        }



        return $this->render('pro_stage/ajoutStagesEnBd.html.twig',['formulaireAjoutStage' => $formulaireStage -> createView ()]
        );
    }


    /**
     * @Route("/ajoutEntreprisesEnBd", name="pro_stage_ajoutEntreprisesEnBd")
     */
    public function ajoutEntreprisesEnBd(Request $requeteHttp, EntityManagerInterface $manager) 
    {
        $entreprise = new Entreprise();

        $formulaireEntreprise = $this->createForm(EntrepriseType::class,$entreprise);

        $formulaireEntreprise -> handleRequest ( $requeteHttp );


        if($formulaireEntreprise->isSubmitted()&&$formulaireEntreprise->isValid())
        {
            $manager->persist($entreprise);
            $manager->flush();

            return $this->redirectToRoute('pro_stage_accueil');
        }



        return $this->render('pro_stage/ajoutEntreprisesEnBd.html.twig',['formulaireAjoutModifEntreprise' => $formulaireEntreprise -> createView (),
        'choix'=>'creation']
        );
    }

    /**
     * @Route("/modificationEntreprise/{id}", name="pro_stage_modificationEntreprisesEnBd")
     */
    public function modificationEntreprisesEnBd(Request $requeteHTTP, EntityManagerInterface $manager, Entreprise $entreprise): Response
    {
        $formulaireEntreprise =$this->createForm(EntrepriseType::class,$entreprise);


        $formulaireEntreprise->handleRequest($requeteHTTP);

      
        if($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
        {
        $manager->persist($entreprise);
        $manager->flush();

        return $this->redirectToRoute('pro_stage_accueil');
        }

        return $this->render('pro_stage/ajoutEntreprisesEnBd.html.twig', 
        ['formulaireAjoutModifEntreprise' => $formulaireEntreprise->createView (),
        'choix' => 'modifier']);
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
