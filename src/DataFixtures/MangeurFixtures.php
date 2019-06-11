<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Mangeur;

class MangeurFixtures extends BaseFixture
{
	public function loadData(ObjectManager $manager)
    {
		$this->createMany(Mangeur::class, 3, function(Mangeur $mangeur, $count)
		{
			$mangeur->setNom($this->faker->lastName());
			$mangeur->setPrenom($this->faker->firstName());
			$mangeur->setDescription($this->faker->text(200));
			$mangeur->setAdresse($this->faker->address());
			$mangeur->setEmail($this->faker->email());
    	});
    	
        $manager->flush();
    }
}
