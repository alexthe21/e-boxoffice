<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/01/15
 * Time: 18:42
 */

namespace At21\EBoxOfficeBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'datetime', array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'html5' => true
            ))
            ->add('title', 'text')
            ->add('description', 'text')
            ->add('price', 'money', array(
                'currency' =>'GBP'
            ))
            ->add('theatre', 'entity', array(
                'class' => 'At21EBoxOfficeBundle:Theatre',
                'property' => 'name',
            ))
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'event';
    }
}