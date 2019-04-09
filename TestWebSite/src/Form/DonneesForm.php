<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonneesForm extends AbstractType
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
          array ('label' => 'Type de Lieu : ',
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
      ->add('typeDonnee', ChoiceType::class,
          array ('label' => 'Type de Lieu : ',
            'choices' => array(
              'co2' => 4,
              'luminosité intérieur' => 3,
              'temperature' => 1,
              'luminusité exterieur' => 5,
              'humidité' => 2,
              )
            ))
      ->add('Ok',SubmitType::class,  array(
    'attr' => array('style' => "width:194px;")));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'App\Entity\Donnees'
    ));
  }
}
