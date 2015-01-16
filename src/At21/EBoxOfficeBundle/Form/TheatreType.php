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
            ->add('date', 'datetime')
            ->add('title', 'text')
            ->add('theatre', 'text')
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'event';
    }
}