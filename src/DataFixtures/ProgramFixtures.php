<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'South Park', 'synopsis' => 'Des enfants très vulgaires qui ne grandissent jamais.', 'category' => 'category_Animation'],
        ['title' => 'Breaking Bad', 'synopsis' => 'Un professeur de chimie pète les plombs et fabrique de la drogue. La drogue c\'est maaaal !', 'category' => 'category_Action'],
        ['title' => 'American Horror Story', 'synopsis' => 'Une série américaine d\'épouvante. Selon les saisons, la qualité est très inégale', 'category' => 'category_Horreur'],
        ['title' => 'Them', 'synopsis' => 'Une famille afro-américaine, à l\'époque de la ségrégation raciale, souffre du racisme mais aussi d\'une étrange malédiction.', 'category' => 'category_Horreur'],
        ['title' => 'Walking Dead', 'synopsis' => 'Des zombies envahissent la terre.', 'category' => 'category_Action'],
        ['title' => 'The Witcher', 'synopsis' => 'Un sorceleur affronte des monstres dans une contrée où il fait toujours sombre et où les intrigues et les dialogues sont mous !', 'category' => 'category_Aventure'],
        ['title' => 'Dark', 'synopsis' => 'Une série allemande mystériseuse dans laquelle les personnages voyagent dans le temps.', 'category' => 'category_Fantastique'],
        ['title' => 'Futurama', 'synopsis' => 'Une critique acide et très drôle de l\'an 3000.', 'category' => 'category_Animation'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $programName) {
            $program = new Program();
            $program->setTitle($programName['title'])
                    ->setSynopsis($programName['synopsis'])
                    ->setCategory($this->getReference($programName['category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFictures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
