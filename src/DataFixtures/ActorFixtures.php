<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('hu_HU');
        for($n = 0; $n <30; $n++) {
        // $product = new Product();
        // $manager->persist($product);
        $actor = new Actor();
        // mise en place du Faker 
        $actor->setName($faker->firstNameMale() . ' ' . $faker->lastName());
        for($i = 0; $i < 3; $i++) {
        $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1, 11)));
        }
        $manager->persist($actor);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
           ProgramFixtures::class,
        ];
    }
}
