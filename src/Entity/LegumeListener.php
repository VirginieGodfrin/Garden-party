<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Constraints as Assert;


class LegumeListener
{
    /** @ORM\PrePersist */
    public function PrePersistRenameSoupe(Legume $legume, LifecycleEventArgs $args) { 
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
    public function PreUpdateValideName(Legume $legume, PreUpdateEventArgs $args) {
        $changeField = null;
        $field = '';

        if ($args->getEntity() instanceof Legume) {

            $changeSet = $args->getEntityChangeSet();

            foreach ($changeSet as $key => $value) {
                if($key = 'nom'){
                   $changeField = $args->hasChangedField('nom');
                   $field = 'nom';
                }
            }

            if (true === $changeField) {
                $oldValue = $args->getOldValue($field);
                $newValue = $args->getNewValue($field);
                $this->validateName($newValue, $oldValue);
            }
        }
    }

    private function validateName($newValue, $oldValue)
    {
        if($newValue !== $oldValue){
            throw new NotFoundHttpException("Il ne fallait pas changer de nom de légume");
        }
    }

}