<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('salle', ChoiceType::class,
          array('label' =>'Salle :',
            'choices'  => array(
              'U3 101' => 1,
              'U3 102' => 2,
              'U3 103' => 3,
          )
      ))
      ->add('Ok',SubmitType::class,  array(
    'attr' => array('style' => "width:194px;")));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'App\Entity\Salle'
    ));
  }
}
