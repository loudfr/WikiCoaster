<?php

namespace App\Form;

use App\Entity\Coaster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Park;
use App\Entity\Category;

class CoasterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('maxSpeed')
            ->add('length')
            ->add('maxHeight')
            ->add('operating')
            ->add('park', EntityType::class, [
                'class' => Park::class,
                //champ vierge de base
                //'require' => false,
            ])
            ->add('Categories', EntityType::class, [
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Coaster::class,
        ]);
    }

}
