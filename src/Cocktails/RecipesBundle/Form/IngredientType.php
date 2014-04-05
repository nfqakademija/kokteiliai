<?php

namespace Cocktails\RecipesBundle\Form;

use Cocktails\RecipesBundle\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IngredientType extends AbstractType
{
    /**
     * @var Recipe
     */
    private $recipe;

    /**
     * @param Recipe $recipe
     */
    public function __constructor(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('ingredient', 'entity', array(
            'class' => 'CocktailsRecipesBundle:Ingredient',
            'property' => 'name',
            'label' => 'Ingredient'
        ));

        $builder->add('recipe', 'hidden', array('data' => $this->recipe));

//        $builder->addEventListener(
//            FormEvents::POST_SET_DATA,
//            function (FormEvent $event) {
//                $form = $event->getForm();
//                $recipeField = $form->get('recipe')->setData(1);
//                //$recipeField->setData($this->recipe->getId());
//            }
//        );

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cocktails\RecipesBundle\Entity\RecipesIngredients'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cocktails_recipesbundle_ingredient';
    }


}
