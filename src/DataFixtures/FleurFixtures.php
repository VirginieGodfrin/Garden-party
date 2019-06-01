<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Fleur;

class FleurFixtures extends BaseFixture
{
    private static $name = [
			'Paquerette',
			'Capucine',
			'Escargots',
			'Clématite',
			'Iris',
			'Petunia',
			'Plantain',
			'Violette',
			'Zinnia',
			'Rose'
		];

	private static $description = [
				'Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic.',
				'Gumbo beet greens corn soko endive gumbo gourd. Parsley shallot courgette tatsoi pea sprouts fava bean collard greens dandelion okra wakame tomato.',
				'Turnip greens yarrow ricebean rutabaga endive cauliflower sea lettuce kohlrabi amaranth water spinach avocado daikon napa cabbage asparagus winter purslane kale.'
	];

	private static $bouquet = [
				'Le bouquet du jardinner',
				'Le bouquet de printemps',
				'Le bouquet des mamans',
				'Le bouquet de la marièe',
				'Le bouquet des champs'
	];

    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Fleur::class, 10, function(Fleur $fleur, $count)
		{
			$fleur->setNom($this->faker->randomElement(self::$name));
			$fleur->setDescription($this->faker->randomElement(self::$description));
			$fleur->setBouquet($this->faker->randomElement(self::$bouquet));
			$fleur->setCouleur($this->faker->colorName());
    	});
    	
        $manager->flush();
    }
}
