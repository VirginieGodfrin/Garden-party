<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Jardinier;

class JardinierFixtures extends BaseFixture
{
	private static $outil = [
		'Arrosoir',
		'Bêche',
		'Cisaille',
		'Plantoir',
		'Pelle',
		'Râteau'
	];

	private static $mission = [
		'Nourrir les poules',
		'Retourner le jardin',
		'Couper la haie',
		'Planter des salades',
		'Ramasser les pommes',
		'Faire la sieste'
	];
    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Jardinier::class, 2, function(Jardinier $jardinier, $count)
		{
			$jardinier->setNom($this->faker->lastName());
			$jardinier->setPrenom($this->faker->firstName());
			$jardinier->setDescription($this->faker->text());
			$jardinier->setOutil($this->faker->randomElement(self::$outil));
			$jardinier->setMission($this->faker->randomElement(self::$mission));
    	});
    	
        $manager->flush();
    }
}
