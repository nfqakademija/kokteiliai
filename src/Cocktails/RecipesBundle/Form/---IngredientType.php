<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('name', 'text');
        $builder->add('name', 'entity', array(
            'class' => 'CocktailsRecipesBundle:Ingredient',
            'property' => 'username',
        ));
    }

    public function getName()
    {
        return 'ingredient';
    }
}
