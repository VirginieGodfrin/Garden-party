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
            ->add('nom', null,[
                'label' => 'nom',
                'required'=> true,
                'translation_domain' => 'fleurForm',
            ])
            ->add('description', null,[
                'label' => 'description',
                'required'=> true,
                'translation_domain' => 'fleurForm',
            ])
            ->add('mangeur', EntityType::class, [
                'class' => Mangeur::class,
                'label' => 'mangeur',
                'choice_label' => 'fullName',
                'translation_domain' => 'fleurForm',
            ])
            ->add('jardiniers', EntityType::class, [
                'class' => Jardinier::class,
                'label' => 'jardiniers',
                'choice_label' => function(Jardinier $jardinier) {
                    return sprintf('(%d) %s', $jardinier->getId(), $jardinier->getFullName());
                },
                'expanded'  => false,
                'multiple'  => true,
                'placeholder' => 'Choisis un jardinnier',
                'by_reference' => false,
                'translation_domain' => 'fleurForm',
            ])
            ->add('legumes', EntityType::class, [
                'class' => Legume::class,
                'label' => 'legumes',
                'choice_label' => function(Legume $legume) {
                    return sprintf('(%d) %s', $legume->getId(), $legume->getNom());
                },
                'expanded'  => false,
                'multiple'  => true,
                'placeholder' => 'Choisis un légume',
                'by_reference' => false,
                'translation_domain' => 'fleurForm',
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'save',
                ],
                'translation_domain' => 'fleurForm',
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
