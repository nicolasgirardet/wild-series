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

        for($p = 0; $p <= 7; $p++){
            for($s = 1; $s <= 10; $s++){
            //$season->setNumber($faker->numberBetween(1, 10));
            $season = new Season();
            $season->setYear($faker->year());
            $season->setDescription($faker->paragraphs(3, true));
            $season->setProgram($this->getReference('program_' . $p));
            $season->setNumber($s);
                
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


        /*for ($i = 0; $i < $nbOfPrograms; $i++) {
            $program = $this->getReference('program_' . $i);

            for ($j = 0; $j <= $nbOfPrograms; $j++) {

                //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                
                $season = new Season();
                
                $season->setNumber($j + 1)
                    ->setYear($faker->year())
                    ->setDescription($faker->paragraphs(2, true))
                    ->setProgram($this->getReference('program_' . $faker->numberBetween(0, 11)));


                $manager->persist($season);
            }
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFictures dépend
        return [
            ProgramFixtures::class,
        ];
    }*/
}
