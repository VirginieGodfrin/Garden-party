<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Jardinier;
use App\Entity\Fleur;
use App\Entity\Fruit;
use App\Entity\Legume;
use App\Entity\Arbre;

class JardinierFixtures extends BaseFixture implements DependentFixtureInterface
{

    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Jardinier::class, 5, function(Jardinier $jardinier, $count)
		{
			$jardinier->setNom($this->faker->lastName());
			$jardinier->setPrenom($this->faker->firstName());
			$jardinier->setDescription($this->faker->text());
			$fleurs = $this->getRandomReferences(Fleur::class, $this->faker->numberBetween(0, 5));
			$fruits = $this->getRandomReferences(Fruit::class, $this->faker->numberBetween(0, 5));
			$legumes = $this->getRandomReferences(Legume::class, $this->faker->numberBetween(0, 5));
			$arbres = $this->getRandomReferences(Arbre::class, $this->faker->numberBetween(0, 5));

            foreach ($fleurs as $fleur) {
                $jardinier->addVegetal($fleur);
            }

            foreach ($fruits as $fruit) {
                $jardinier->addVegetal($fruit);
            }
            foreach ($legumes as $legume) {
                $jardinier->addVegetal($legume);
            }

            foreach ($arbres as $arbre) {
                $jardinier->addVegetal($arbre);
            }
    	});
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FleurFixtures::class,
            FruitFixtures::class,
            LegumeFixtures::class,
            ArbreFixtures::class,
        ];
    }
}
