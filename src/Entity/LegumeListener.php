<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;



class LegumeListener
{
    /** @ORM\PrePersist */
    public function prePersistRenameSoupe(Legume $legume, LifecycleEventArgs $args) { 
        // $this->logger->info('I love Tony Vairelles\' hairdresser.');
        $em = $args->getObjectManager();
        $entity = $args->getObject();
        // dump($em);
        // dump($entity);
        // dump($legume); 
        if ($legume instanceof Legume && $legume->getFleurs() && $legume->getNom() ) {
            $fleurs = $legume->getFleurs();
            $nomDeFleurs = "";
            foreach ($fleurs as $fleur) {
                $nomDeFleurs .= $fleur->getNom(). '/';
            }
            $legume->setSoupe("Soupe de ".$legume->getNom(). " et de " . $nomDeFleurs);
        }
        dump($legume);
    }

    // /** @PostPersist */
    // public function postPersistHandler(Legumes $legumes, LifecycleEventArgs $event) { 
   	// 	//...
    // }

    // /** @PreUpdate */
    // public function preUpdateHandler(Legumes $legumes, PreUpdateEventArgs $event) { 
    // // ...
    // }

    // /** @PostUpdate */
    // public function postUpdateHandler(Legumes $legumes, LifecycleEventArgs $event) { 
    // // ...
    // }

    // /** @PostRemove */
    // public function postRemoveHandler(Legumes $legumes, LifecycleEventArgs $event) { 
    // // ...
    // }

    // /** @PreRemove */
    // public function preRemoveHandler(Legumes $legumes, LifecycleEventArgs $event) { 
    // // ...
    // }

    // /** @PreFlush */
    // public function preFlushHandler(Legumes $legumes, PreFlushEventArgs $event) { 
    // // ...
    // }

    // /** @PostLoad */
    // public function postLoadHandler(Legumes $legumes, LifecycleEventArgs $event) { 
    // // ...
    // }
}