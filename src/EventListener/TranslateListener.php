<?php

namespace App\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
Use App\Entity\Fleur;

class TranslateListener
{
	private $session;

	public function __construct(SessionInterface $session)
	{
	    $this->session = $session;
	}

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Fleur) {
            return;
        }

        $em= $args->getObjectManager();

        $fleur = $em->getRepository(Fleur::class)->findOneById($entity->getId());
        // dump($fleur);
		$fleur->setNom('Florwer name');
		$fleur->setDescription('Flower description');
		$fleur->setTranslatableLocale('en');

		$repository = $em->getRepository('Gedmo\Translatable\Entity\Translation');
		$translations = $repository->findTranslations($fleur);

		dump($fleur);
		dump($repository);
		dump($translations); die;
		// $em->persist($fleur);
		// $em->flush();
    }
}