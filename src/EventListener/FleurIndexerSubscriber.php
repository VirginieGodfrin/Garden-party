<?php

namespace App\EventListener;

use App\Entity\Fleur;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class FleurIndexerSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::postPersist,
        ];
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->preIndex($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->postIndex($args);
    }

    public function preIndex(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof Fleur) {
            $em = $args->getObjectManager();
            $this->setColor($entity);
        }
    }

    public function postIndex(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof Fleur) {
            $em = $args->getObjectManager();
            $this->setBouquet($entity);
            $em->flush();
        }
    }

    private function setBouquet($entity){
        $entity->setBouquet('Le buquet de ' . $entity->getNom());
    }

    private function setColor($entity){
        $entity->setCouleur($this->random_color());
    }

    private function random_color_part() {

        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    private function random_color() {
        return '#' . $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }
}