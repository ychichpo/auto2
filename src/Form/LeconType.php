<?php

namespace App\Form;

use App\Entity\Lecon;
use App\Entity\User;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeconType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reglee')
            ->add('rdv', null, [
                'widget' => 'single_text',
            ])
            ->add('code_moniteur', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user) {
                    return $user->getNom() . ' ' . $user->getPrenom();
                },
            ])

            ->add('immatriculation', EntityType::class, [
                'class' => Vehicule::class,
                'choice_label' => function(Vehicule $vehicule) {
                    return $vehicule->getMarque() . ' ' . $vehicule->getModele();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lecon::class,
        ]);
    }
}
