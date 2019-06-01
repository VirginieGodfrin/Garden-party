<?php

namespace App\DataFixtures;


use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Fruit;


class FruitFixtures extends BaseFixture
{
    private static $name = [
			'Pomme',
			'Poire',
			'Pêche',
			'Abricot',
			'Fraise',
			'Groseille',
			'Framboise',
			'Melon',
			'Orange',
			'Noix'
		];

	private static $arbre = [
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

	private static $salade = [
			'De pomme',
			'De poire',
			'De pêche',
			'D\'abricot',
			'De fraise',
			'De groseille',
			'De framboise',
			'De melon',
			'D\'orange',
			'De kiwi aux noix'
		];

	private static $description = [
				'Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic.',
				'Gumbo beet greens corn soko endive gumbo gourd. Parsley shallot courgette tatsoi pea sprouts fava bean collard greens dandelion okra wakame tomato.',
				'Turnip greens yarrow ricebean rutabaga endive cauliflower sea lettuce kohlrabi amaranth water spinach avocado daikon napa cabbage asparagus winter purslane kale.'
	];

    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Fruit::class, 10, function(Fruit $fruit, $count)
		{
			$fruit->setNom($this->faker->randomElement(self::$name));
			$fruit->setDescription($this->faker->randomElement(self::$description));
			$fruit->setArbre($this->faker->randomElement(self::$arbre));
			$fruit->setSalade($this->faker->randomElement(self::$salade));
    	});
    	
        $manager->flush();
    }
}
