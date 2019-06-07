<?php

namespace App\Form;

use App\Entity\Vegetal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VegetalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('slug')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('jardiniers')
            ->add('mangeur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vegetal::class,
        ]);
    }
}
