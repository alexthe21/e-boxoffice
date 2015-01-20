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

class PlayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fromDate', 'datetime', array(
                'format' => 'yyyy-MM-dd',
                'widget' => 'single_text',
                'html5' => true,
            ))
            ->add('toDate', 'datetime', array(
                'format' => 'yyyy-MM-dd',
                'widget' => 'single_text',
                'html5' => true,
            ))
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'play';
    }
}