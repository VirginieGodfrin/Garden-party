<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Legume;
use App\Entity\Mangeur;
use App\Entity\Fleur;

class LegumeFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $name = [
			'Courgette',
			'Tomate',
			'Asperge',
			'Champignon',
			'Haricot',
			'Petits poids',
			'Scarolle',
			'Chicon',
			'Carotte',
			'Choux'
		];

	private static $description = [
				'Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic.',
				'Gumbo beet greens corn soko endive gumbo gourd. Parsley shallot courgette tatsoi pea sprouts fava bean collard greens dandelion okra wakame tomato.',
				'Turnip greens yarrow ricebean rutabaga endive cauliflower sea lettuce kohlrabi amaranth water spinach avocado daikon napa cabbage asparagus winter purslane kale.'
	];

	private static $taille = [
				'Grand',
				'Petit',
				'Moyen',
				'Incomparable',
				'Minuscule'
	];

    public function loadData(ObjectManager $manager)
    {
		$this->createMany(Legume::class, 10, function(Legume $legume, $count)
		{
			$legume->setNom($this->faker->randomElement(self::$name));
			$legume->setDescription($this->faker->randomElement(self::$description));
			$legume->setTaille($this->faker->randomElement(self::$taille));
			$legume->setCreatedAt($this->faker->dateTimeThisMonth());
			$legume->setMangeur($this->getRandomReference(Mangeur::class));
			
			$fleurs = $this->getRandomReferences(Fleur::class, $this->faker->numberBetween(0, 5));
            foreach ($fleurs as $fleur) {
                $legume->addFleur($fleur);
            }
    	});
    	
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ 
        	MangeurFixtures::class,
        	FleurFixtures::class
         ];
    }
}
