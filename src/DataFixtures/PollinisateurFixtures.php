<?php

namespace App\DataFixtures;

use App\DataFixtures\BaseFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Pollinisateur;

class PollinisateurFixtures extends BaseFixture
{
	private static $name = [
			'Abeille',
			'Bourdon',
			'Papillon',
		];

	private static $description = [
				'Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic.',
				'Gumbo beet greens corn soko endive gumbo gourd. Parsley shallot courgette tatsoi pea sprouts fava bean collard greens dandelion okra wakame tomato.',
				'Turnip greens yarrow ricebean rutabaga endive cauliflower sea lettuce kohlrabi amaranth water spinach avocado daikon napa cabbage asparagus winter purslane kale.'
	];

	private static $fleur = [
				'Plantain',
				'Coquelicot',
				'Scorsonère'
	];

    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Pollinisateur::class, 10, function(Pollinisateur $pollinisateur, $count)
		{
			$pollinisateur->setName($this->faker->randomElement(self::$name));
			$pollinisateur->setDescription($this->faker->randomElement(self::$description));
			$pollinisateur->setFleur($this->faker->randomElement(self::$fleur));
    	});
    	
        $manager->flush();
    }
}
