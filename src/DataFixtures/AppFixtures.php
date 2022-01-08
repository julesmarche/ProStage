<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création générateur de données faker
        $faker = \Faker\Factory::create('fr_FR');

        // Création formations
        $dutInfo = new Formation();
        $dutInfo->setNomLong("DUT Informatique");
        $dutInfo->setNomCourt("DUT Info");

        $dutInfoImagNum = new Formation();
        $dutInfoImagNum->setNomLong("DUT Informatique et Imagerie Numérique");
        $dutInfoImagNum->setNomCourt("DUT IIM");

        $dutGea = new Formation();
        $dutGea->setNomLong("DUT Gestion des entreprises et des administrations");
        $dutGea->setNomCourt("DUT GEA");

        $lpProg = new Formation();
        $lpProg->setNomLong("Licence programmation");
        $lpProg->setNomCourt("LP");

        $dutGenieLogiciel = new Formation();
        $dutGenieLogiciel->setNomLong("DUT Genie Logiciel");
        $dutGenieLogiciel->setNomCourt("DUT GL");


        $tableauFormations=array($dutInfo, $dutInfoImagNum, $dutGea, $lpProg, $dutGenieLogiciel);

        //Enregistrement et vérification
        foreach($tableauFormations as $formation)
        {
            $manager->persist($formation);
        }


        //Création des entreprises
        

        for($i=0 ; $i<15 ; $i++)
        {
            $entreprise = new Entreprise();
            $entreprise->setActivite($faker->realText($maxNbChars = 50, $indexSize = 2));
            $entreprise->setAdresse($faker->address);
            $entreprise->setNom($faker->company);
            $entreprise->setURLsite($faker->url);

            $entreprises[]=$entreprise;
            $manager->persist($entreprise);

        }
        

        
        for($i=0 ; $i<30 ; $i++)
        {

            $entrepriseAssocieAuStage = $faker->numberBetween($min=0 , $max=14);
       
            $nombreDeFormations = $faker->numberBetween($min=0, $max=2);

            $stage = new Stage();
            $stage->setTitre($faker->realText($maxNbChars = 50, $indexSize = 2));
            $stage->setDescriptionMissions($faker->realtext());
            $stage->setEmailContact($faker->email);
            $stage->setEntreprise($entreprises[$entrepriseAssocieAuStage]);
            
            for($j=0 ; $j<$nombreDeFormations ; $j++)
            {
                $formationAssocieeAuStage = $faker->unique()->numberBetween($min=0, $max=4);
                $stage->addTypeFormation($tableauFormations[$formationAssocieeAuStage]);
            }
            $faker->unique($reset = true);
            
            $manager->persist($stage);
        }
        
        $manager->flush();
    }
}
