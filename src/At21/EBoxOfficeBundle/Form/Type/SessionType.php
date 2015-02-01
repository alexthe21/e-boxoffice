<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/01/15
 * Time: 18:42
 */

namespace At21\EBoxOfficeBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'datetime', array(
                /*'format' => 'yyyy-MM-dd H:i:s',*/
                'widget' => 'single_text',
                'html5' => true,
            ))
            ->add('price', 'money', array(
                'currency' =>'GBP'
            ))
            ->add('play', 'entity', array(
                'class' => 'At21EBoxOfficeBundle:Play',
                'property' => 'title',
                'disabled' => true,
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
        return 'session';
    }
}