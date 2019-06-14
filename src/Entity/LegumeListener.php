<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class LegumeListener
{
    /** @ORM\PrePersist */
    public function prePersistRenameSoupe(Legume $legume, LifecycleEventArgs $args) { 
        $em = $args->getObjectManager();
        $entity = $args->getObject();

        if ($legume instanceof Legume && $legume->getFleurs() && $legume->getNom() ) {
            $fleurs = $legume->getFleurs();
            $nomDeFleurs = "";
            foreach ($fleurs as $fleur) {
                $nomDeFleurs .= $fleur->getNom(). '/';
            }
            $legume->setSoupe("Soupe de ".$legume->getNom(). " et de " . $nomDeFleurs);
        }

    }

    /** @ORM\PreUpdate */
    public function preUpdateValideName(PreUpdateEventArgs $args) { 
        $entity = $args->getEntity();
        $changeSet = $args->getEntityChangeSet();
        $changeField = $args->hasChangedField('nom');
        $oldValue = $args->getOldValue('nom');
        $newValue = $args->getNewValue('nom');

        if ($args->getEntity() instanceof legume) {
            if ($args->hasChangedField('nom')) {
                $this->validateName($newValue);
            }
        }
    }

    private function validateName($newValue)
    {
        if($newValue == "carotte"){
            throw new NotFoundHttpException("Il ne fallait pas appeler son légume carotte");
        }
    }

}