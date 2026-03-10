<?php
namespace App\Form;

use App\Entity\Conf;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('conf', EntityType::class, [
                'class' => Conf::class,
                'choice_label' => 'titre',
            ])
            ->add('dateresa', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('materiels', CollectionType::class, [
                'entry_type' => MaterielSelectionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }
}
