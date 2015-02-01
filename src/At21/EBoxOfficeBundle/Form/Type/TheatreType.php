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

class TheatreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberOfRows', 'integer')
            ->add('numberOfSeatsPerRow', 'integer')
            ->add('name', 'text')
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'theatre';
    }
}