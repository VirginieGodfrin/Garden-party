<?php

namespace App\DataFixtures;

use App\DataFixtures\BaseFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Decomposeur;


class DecomposeurFixtures extends BaseFixture
{
	private static $name = [
			'Lombric',
			'Collembole',
			'Escargots',
		];

	private static $description = [
				'Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic.',
				'Gumbo beet greens corn soko endive gumbo gourd. Parsley shallot courgette tatsoi pea sprouts fava bean collard greens dandelion okra wakame tomato.',
				'Turnip greens yarrow ricebean rutabaga endive cauliflower sea lettuce kohlrabi amaranth water spinach avocado daikon napa cabbage asparagus winter purslane kale.'
	];

	private static $debris = [
				'Feuilles mortes',
				'Animaux morts',
				'Excréments '
	];

    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Decomposeur::class, 10, function(Decomposeur $decomposeur, $count)
		{
			$decomposeur->setName($this->faker->randomElement(self::$name));
			$decomposeur->setDescription($this->faker->randomElement(self::$description));
			$decomposeur->setDebris($this->faker->randomElement(self::$debris));
    	});
    	
        $manager->flush();
    }
}