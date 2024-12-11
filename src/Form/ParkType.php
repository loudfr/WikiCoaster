<?php

namespace App\Form;

use App\Entity\Park;
use Symfony\Component\Form\AbstractType;
use Symfony\component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('country', CountryType::class,[
                'preferred_choices' => ['FR','DE','BE']])
            ->add('openingYear')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Park::class,
        ]);
    }
}
