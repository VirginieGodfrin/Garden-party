<?php

namespace App\Form;

use App\Entity\Legume;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Jardinier;
use App\Entity\Mangeur;
use App\Entity\Fleur;


class LegumeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('taille')
            ->add('jardiniers', EntityType::class, [
                'class' => Jardinier::class,
                'choice_label' => function(Jardinier $jardinier) {
                    return sprintf('(%d) %s', $jardinier->getId(), $jardinier->getFullName());
                },
                'expanded'  => false,
                'multiple'  => true,
                'placeholder' => 'Choisis un jardinnier',
                'by_reference' => false,
            ])
            ->add('mangeur', EntityType::class, [
                'class' => Mangeur::class,
                'choice_label' => 'fullName',
            ])
            ->add('fleurs', EntityType::class, [
                'class' => Fleur::class,
                'choice_label' => function(Fleur $fleur) {
                    return sprintf('(%d) %s', $fleur->getId(), $fleur->getNom());
                },
                'expanded'  => false,
                'multiple'  => true,
                'placeholder' => 'Choisis une fleur',
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'save',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Legume::class,
        ]);
    }
}
