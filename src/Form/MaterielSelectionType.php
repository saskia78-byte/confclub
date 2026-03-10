<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\Materielconf;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielSelectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('materiel', EntityType::class, [
                'class' => Materiel::class,
                'choice_label' => 'libelle',
                'attr' => ['class' => 'w-full bg-slate-900 border border-slate-700 text-white text-sm rounded-lg px-4 py-3 focus:outline-none focus:border-indigo-500 transition-colors'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materielconf::class,
        ]);
    }
}
