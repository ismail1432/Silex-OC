<?php

namespace WebLinks\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array( 'required' => true,))
                ->add('url', 'text', array( 'required' => true,));
       // $builder->add('save', 'submit');

    }

    public function getName()
    {
        return 'link';
    }
}