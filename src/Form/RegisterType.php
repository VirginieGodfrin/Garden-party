<?php

namespace App\Form;

use App\Form\Model\RegisterFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
Use App\Entity\User;
Use App\Entity\Jardinier;
use App\Entity\Mangeur;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('type', ChoiceType::class, [
                    'choices' => [
                        new Jardinier(Jardinier::class),
                        new Mangeur(Mangeur::class),
                    ],
                    'choice_label' => 'ClassName',
                    'mapped' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
