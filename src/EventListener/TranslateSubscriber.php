<?php 

namespace App\EventListener;

use App\Entity\Fleur;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;
// use Gedmo\Translatable\TranslatableListener;


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
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->setTranslatableLocale($args);
        $this->setTranslation($args);
    }

    public function setTranslatableLocale(LifecycleEventArgs $args)
    {
    	$userLocale = $this->session->get('_locale');

        $entity = $args->getObject();

        if ($entity instanceof Fleur) {
            $entity->setTranslatableLocale('en');
        }
    }

    public function setTranslation(LifecycleEventArgs $args)
    {
	    $entity = $args->getObject();
	    $em= $args->getObjectManager();
	    $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        if ($entity instanceof Fleur) {
        	$repository
        		->translate($entity, 'bouquet', 'en', 'bouquet in englis')
			    ->translate($entity, 'nom', 'en', 'nom en english')
			    ->translate($entity, 'description', 'en', 'description in english')
			    ->translate($entity, 'couleur', 'ru', 'couleur in english')
			;
        }
    }
}
