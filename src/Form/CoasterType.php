<?php

namespace App\Form;

use App\Entity\Coaster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use App\Entity\Park;
use App\Entity\Category;
use Doctrine\ORM\QueryBuilder;
use App\Utils\Countries;

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
                //'group_by' =>  => function(Park $entity): string {
                    //return Countries::getName($entity->getCountry(), 'FR_fr');
                //}, */
            ])
            ->add('Categories', EntityType::class, [
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,
                //'required' => false,   
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
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
