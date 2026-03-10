<?php

namespace App\Form;

use App\Entity\Theme; 
use App\Entity\Conf;
use App\Entity\Conferencier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('dateConf')
            ->add('statut')
            ->add('conferencier', EntityType::class, [
                'class' => Conferencier::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'libelle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conf::class,
        ]);
    }
}
