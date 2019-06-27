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

	public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Fleur) {
            return;
        }

        $em= $args->getObjectManager();

        $fleur = $em->getRepository(Fleur::class)->findOneById($entity->getId());

		$fleur->setNom('Florwer name');
		$fleur->setDescription('Flower description');
		$fleur->setTranslatableLocale('en');

    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Fleur) {
            return;
        }

        $em= $args->getObjectManager();

        $fleur = $em->getRepository(Fleur::class)->findOneById($entity->getId());

		$fleur->setNom('Florwer name');
		$fleur->setDescription('Flower description');
		$fleur->setTranslatableLocale('en');

    }
}