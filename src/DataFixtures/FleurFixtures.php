<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Fleur;
use App\Entity\Mangeur;

class FleurFixtures extends BaseFixture implements DependentFixtureInterface
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

    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Fleur::class, 10, function(Fleur $fleur, $count)
		{
			$fleur->setTranslatableLocale('en');
			$fleur->setNom($this->faker->randomElement(self::$name));
			$fleur->setDescription($this->faker->randomElement(self::$description));
			$fleur->setCreatedAt($this->faker->dateTimeThisMonth());
			$fleur->setMangeur($this->getRandomReference(Mangeur::class));
    	});
    	
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ MangeurFixtures::class ];
    }
}
