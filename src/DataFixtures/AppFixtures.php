<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct() {
        $this->faker = Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        $i = 1;
        while ($i <= 10) {
            $question = new Question();
            $question->setStatement("Oh bah qui voilà-je");
            $answer = new Answer();
            $content = $this->faker->sentence(5);
            $answer->setContent($content);
            $created = $this->faker->dateTimeBetween('-1 week', "now");
            $updated = $this->faker->dateTimeBetween($created, "now");
            $question
                ->setCreatedAt($created)
                ->setUpdatedAt($updated)
//                ->addAnswer($answer)
                ->setStatus("on");
            $manager->persist($question);
            $i++;
        };

        $manager->flush();
    }
}
