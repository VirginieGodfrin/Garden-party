<?php

namespace App\DataFixtures;

use App\DataFixtures\BaseFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Arbre;
use App\Entity\Mangeur;


class ArbreFixtures extends BaseFixture
{
	private static $nom = [
		'Pommier',
		'Poirier',
		'Pêchier',
		'Abricotier',
		'Fraisier',
		'Groseillier',
		'Framboisier',
		'Melon',
		'Oranger',
		'Noyer'
	];

	private static $type = [
		'feuillus',
		'résineux'
	];

	private static $description = [
		'Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic.',
		'Gumbo beet greens corn soko endive gumbo gourd. Parsley shallot courgette tatsoi pea sprouts fava bean collard greens dandelion okra wakame tomato.',
		'Turnip greens yarrow ricebean rutabaga endive cauliflower sea lettuce kohlrabi amaranth water spinach avocado daikon napa cabbage asparagus winter purslane kale.'
	];

    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Arbre::class, 10, function(Arbre $arbre, $count)
		{
			$arbre->setNom($this->faker->randomElement(self::$nom));
			$arbre->setDescription($this->faker->randomElement(self::$description));
			$arbre->setType($this->faker->randomElement(self::$type));
    	});
    	
        $manager->flush();
    }
}

