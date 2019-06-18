<?php

namespace App\EventListener;

use App\Entity\User;
use App\Entity\Jardinier;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class JardinierIndexer
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        // only act on some "Product" entity
        if (!$entity instanceof User) {
            return;
        }
        $em = $args->getObjectManager();
        $users = $em->getRepository(User::class)->findAll();

        if($entity->getClassName() == 'Jardinier'){
            $this->setMissionAndOutil($users, $entity, $em);
        }
        

    }

    private function setMissionAndOutil($users, $entity, $em){
        foreach ($users as $user) {
            if($user->getId() === $entity->getId() ){
                $entity->setOutil('Tondeuse');
                $entity->setMission('Tondre la pelouse');
                $em->flush();
            }
        } 
    }
}