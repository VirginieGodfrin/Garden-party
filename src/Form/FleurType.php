<?php

namespace App\Form;

use App\Entity\Fleur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Jardinier;
use App\Entity\Mangeur;
use App\Entity\Legume;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FleurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            // ->add('slug')
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('bouquet')
            ->add('couleur')
            ->add('mangeur', EntityType::class, [
                'class' => Mangeur::class,
                'choice_label' => 'fullName',
            ])
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
            ->add('legumes', EntityType::class, [
                'class' => Legume::class,
                'choice_label' => function(Legume $legume) {
                    return sprintf('(%d) %s', $legume->getId(), $legume->getNom());
                },
                'expanded'  => false,
                'multiple'  => true,
                'placeholder' => 'Choisis un légume',
                'by_reference' => false,
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
            'data_class' => Fleur::class,
        ]);
    }
}
