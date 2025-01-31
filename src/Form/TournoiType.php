<?php

namespace App\Form;

use App\Entity\Tournoi;
use App\Constant\TournoiType as TournoiTypeConstant;
use App\Constant\TournoiStatut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du Tournoi'
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date du Tournoi'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => array_combine(TournoiTypeConstant::getTypes(), TournoiTypeConstant::getTypes()),
                'label' => 'Type de Tournoi'
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => array_combine(TournoiStatut::getStatuts(), TournoiStatut::getStatuts()),
                'label' => 'Statut du Tournoi'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Créer le Tournoi'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
        ]);
    }
}
