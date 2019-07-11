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
            Events::postPersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $userLocale = $this->session->get('_locale');

        if(!$userLocale ){
            $this->setEnTranslatableLocale($args);
            $this->setEnTranslation($args);
        }
        
        if($userLocale == 'fr'){
            $this->setEnTranslatableLocale($args);
            $this->setEnTranslation($args);
        }

        if($userLocale == 'en'){
            $this->setFrTranslatableLocale($args);
            $this->setFrTranslation($args);
        }
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $userLocale = $this->session->get('_locale');

        if(!$userLocale ){
            $this->setEnTranslatableLocale($args);
            $this->setEnTranslationSlug($args);
        }
        
        if($userLocale == 'fr'){
            $this->setEnTranslationSlug($args);
        }

        if($userLocale == 'en'){
            $this->setFrTranslatableLocale($args);
            $this->setFrTranslationSlug($args);
        }
    }

    public function setEnTranslatableLocale(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Fleur) {
            $entity->setTranslatableLocale('en');
        }
    }

    public function setFrTranslatableLocale(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof Fleur) {
            $entity->setTranslatableLocale('fr');
        }
    }

    public function setEnTranslation(LifecycleEventArgs $args)
    {
	    $entity = $args->getObject();
        
	    $em= $args->getObjectManager();
	    $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        if ($entity instanceof Fleur) {
        	$repository
        		->translate($entity, 'bouquet', 'en', 'bouquet in english')
			    ->translate($entity, 'nom', 'en', 'name in english')
			    ->translate($entity, 'description', 'en', 'description in english')
			    ->translate($entity, 'couleur', 'en', 'green')
			;
        }
    }

    public function setFrTranslation(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $em= $args->getObjectManager();
        
        $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        if ($entity instanceof Fleur) {
            $repository
                ->translate($entity, 'bouquet', 'fr', 'bouquet en français')
                ->translate($entity, 'nom', 'fr', 'nom en français')
                ->translate($entity, 'description', 'fr', 'description en français')
                ->translate($entity, 'couleur', 'fr', 'blue')
            ;
        }
    }

    public function setFrTranslationSlug(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $em= $args->getObjectManager();
        
        $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        if ($entity instanceof Fleur) {
            $frSlug = 'fr-' . $entity->getSlug();

            $repository
                ->translate($entity, 'slug', 'fr', $frSlug);
            ;
            
            $em->flush();
        }
    }

     public function setEnTranslationSlug(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $em= $args->getObjectManager();
        
        $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');



        if ($entity instanceof Fleur) {
            $enSlug = 'en-'. $entity->getSlug();

            $repository
                ->translate($entity, 'slug', 'en', $enSlug);
            ;

            $em->flush();
        }
    }
}
