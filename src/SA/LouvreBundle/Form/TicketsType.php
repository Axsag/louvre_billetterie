<?php

namespace SA\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TicketsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        //->add('idTicket', HiddenType::class)
        ->add('firstname', TextType::class)
        ->add('lastname', TextType::class)
        ->add('country', CountryType::class)
        ->add('birthday', DateType::class, array(
            'label' => 'Date de naissance',
            'years' => range(1900, date('Y')),
            'attr'  => array(
                'class' => 'form-group',
            ),
        ))
        ->add('reduction', CheckboxType::class, array('required' => false))
        ->add('age', HiddenType::class)        
        ->add('price', HiddenType::class)
            
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SA\LouvreBundle\Entity\Tickets'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sa_louvrebundle_tickets';
    }


}
