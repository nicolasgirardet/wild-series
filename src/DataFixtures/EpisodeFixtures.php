<?php


namespace App\DataFixtures;


use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

//Tout d'abord nous ajoutons la classe Factory de FakerPhp

use Faker\Factory;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface 

{

    public function load(ObjectManager $manager): void

    {

        //Puis ici nous demandons à la Factory de nous fournir un Faker

        $faker = Factory::create();

        /**

        * L'objet $faker que tu récupère est l'outil qui va te permettre 

        * de te générer toutes les données que tu souhaites

        */

        for($s = 1; $s <= 5; $s++) {
            for($e = 1; $e <= 10; $e++) {
                $episode = new Episode();
                $episode->setTitle($faker->sentence());
                $episode->setNumber($e);
                $episode->setSynopsis($faker->paragraphs(3, true));
                $episode->setSeason($this->getReference('season_' . $s));

                $manager->persist($episode);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }


        /*for($i = 0; $i < 5; $i++) {
            //$season = $this->getReference('season_' . $i);
            
            for ($j = 0; $j <= 10; $j++) {

            //Ce Faker va nous permettre d'alimenter l'instance de episode que l'on souhaite ajouter en base
            
            $episode = new Episode();

            $episode->setTitle($faker->sentence())
                    ->setNumber($j + 1)
                    ->setSynopsis($faker->paragraphs(3, true))
                    ->setSeason($this->getReference('season_' . $faker->numberBetween(1, 5)));


            $manager->persist($episode);

        }


        $manager->flush();

    }
}

    public function getDependencies()
    {
        return [SeasonFixtures::class,];
    }*/

}