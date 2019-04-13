<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VectorForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('dateDebut', DateTimeType::class)
      ->add('dateFin', DateTimeType::class)
      ->add('typeLieu', ChoiceType::class,
          array ('label' => 'Type de Lieu : ',
            'choices' => array(
              'Building' => 'Building',
              'Room' => 'Room',
              'Cluster' => 'Room',
              'All' => 'All',
              )
            ))
      ->add('lieu', ChoiceType::class,
          array ('label' => 'Lieu : ',
            'choices' => array(
              'U4' => 8,
              'U4 302' => 79,
              'U4 SalLab' => 341,
              'U4 302 ilot1' => 1,
              'U4 302 ilot2' => 2,
              'U4 302 ilot3' => 3,
              'U4 302 ouest' => 4,
              'U4 SalLab 79' => 5,
              'U4 SalLab 57' => 6,
              )
            ))
      ->add('listTypeDonnee', ChoiceType::class,
          array ('label' => 'Liste Type de Donnees : ',
            'choices' => array(
              'co2' => 4,
              'luminosité intérieur' => 3,
              'temperature' => 1,
              'luminusité exterieur' => 5,
              'humidité' => 2,
              ),
            'multiple' => true,
            'expanded' => true,
            ))
      ->add('methode', ChoiceType::class,
          array ('label' => 'Methode : ',
            'choices' => array(
              'Minimum' => 'min',
              'Maximum' => 'max',
              'Mooyenne' => 'avg',
              )
            ))
      ->add('taille', ChoiceType::class,
          array ('label' => 'Taille : ',
            'choices' => array(
              'Seconde' => 'sec',
              'Minute' => 'min',
              'Heure' => 'hour',
              'Jour' => 'day',
              'Mois' => 'mounth',
              'Annee' => 'year',
              )
            ))
      ->add('Ok',SubmitType::class,  array(
    'attr' => array('style' => "width:194px;")));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'App\Entity\Vector'
    ));
  }
}
