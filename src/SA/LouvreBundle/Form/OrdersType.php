<?php

namespace SA\LouvreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrdersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('visiteDate', TextType::class)
        
        ->add('typeOrder',ChoiceType::class, array(
            'choices' => array(
                'Demi-journée' => 0,
                'Journée' => 1,                
            ),
        ))
        ->add('NbTickets',NumberType::class)
        ->add('price', HiddenType::class)
        ->add('codeReservation', HiddenType::class)
        ->add('email', HiddenType::class)
        ->add('tickets', CollectionType::class, array(
            'entry_type' => TicketsType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
        ))
        ->add('Valider', SubmitType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SA\LouvreBundle\Entity\Orders'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sa_louvrebundle_orders';
    }


}
