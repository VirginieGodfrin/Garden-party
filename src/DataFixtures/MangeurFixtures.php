<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Mangeur;
use App\Entity\Fruit;

class MangeurFixtures extends BaseFixture implements DependentFixtureInterface
{
	public function loadData(ObjectManager $manager)
    {
		$this->createMany(Mangeur::class, 10, function(Mangeur $mangeur, $count)
		{
			$mangeur->setNom($this->faker->lastName());
			$mangeur->setPrenom($this->faker->firstName());
			$mangeur->setDescription($this->faker->text(200));
			$mangeur->setAdresse($this->faker->address());
			$mangeur->setEmail($this->faker->email());

			$fruits = $this->getRandomReferences(Fruit::class, $this->faker->numberBetween(0, 5));
            foreach ($fruits as $fruit) {
                $mangeur->setFruits($fruit);
            }
    	});
    	
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ FruitFixtures::class ];
    }
}
