<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stage;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $entreprise = new Entreprise();
        $entreprise->setActivite("Web");
        $entreprise->setAdresse("15 rue Anatole France Anglet");
        $entreprise->setNom("Redmoot");
        $entreprise->setURLsite("https://redmoot.com");
        $manager->persist($entreprise);

        $stage = new Stage();
        $stage->setTitre("Developpeur Web");
        $stage->setDescriptionMissions("Recherche un developpeur Web");
        $stage->setEmailContact("redmoot@contact.fr");
        $stage->setEntreprise($entreprise);

        $manager->persist($stage);

        $manager->flush();
    }
}
