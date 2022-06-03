<?php


namespace App\DataFixtures;


use App\Entity\Season;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

//Tout d'abord nous ajoutons la classe Factory de FakerPhp

use Faker\Factory;


class SeasonFixtures extends Fixture implements DependentFixtureInterface

{

    public function load(ObjectManager $manager): void

    {

        //Puis ici nous demandons à la Factory de nous fournir un Faker

        $faker = Factory::create();

        //$nbOfPrograms = count(ProgramFixtures::PROGRAMS);


        /**

         * L'objet $faker que tu récupère est l'outil qui va te permettre 

         * de te générer toutes les données que tu souhaites

         */

        for($i = 0; $i <= 10; $i++){
            for($j = 1; $j <= 12; $j++){
             $season = new Season();
            $season->setYear($faker->year());
            $season->setDescription($faker->paragraphs(3, true));
            $season->setProgram($this->getReference('program_' . $i));
            $season->setNumber($j);
                
            $manager->persist($season);
            $this->setReference('season_' . $season->getNumber(), $season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
