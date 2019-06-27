<?php 

namespace App\EventListener;

use App\Entity\Fleur;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;


class TranslateSubscriber implements EventSubscriber
{
	private $session;

	private $fleur;


	public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        // $this->setUserLocal($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->setTranslation($args);
    }

    public function setUserLocal(LifecycleEventArgs $args)
    {
    	$userLocale = $this->session->get('_locale');

        $entity = $args->getObject();

        $entity->setTranslatableLocale($userLocale);

        if ($entity instanceof Fleur) {
            $entity->setLocale($userLocale);
        }
    }


    public function setTranslation(LifecycleEventArgs $args)
    {
	    $entity = $args->getObject();
	    $em= $args->getObjectManager();
	    $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        if ($entity instanceof Fleur) {
        	$entity->setTranslatableLocale('fr');
        	$repository
        		->translate($entity, 'bouquet', 'en', 'bouquet in englis')
			    ->translate($entity, 'nom', 'en', 'nom en english')
			    ->translate($entity, 'description', 'en', 'description in english')
			    ->translate($entity, 'couleur', 'ru', 'couleur in english')
			;
        }
    }

    public function setFleur(LifecycleEventArgs $args)
    {
    	$entity = $args->getObject();

        if ($entity instanceof Fleur) {
            $this->fleur = $args->getObject();
        }
    }

    public function setEnLocal(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $em= $args->getObjectManager();

        if ($entity instanceof Fleur) {
        	$fleur = $em->getRepository(Fleur::class)->findOneById($entity->getId());
			$fleur->setTranslatableLocale('en');
			$em->refresh($fleur);
        }
    }

   


}
