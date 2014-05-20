<?php

namespace Cocktails\RecipesBundle\Admin;

use Cocktails\RecipesBundle\Form\IngredientType;
use Proxies\__CG__\Cocktails\RecipesBundle\Entity\Recipe;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Cocktails\RecipesBundle\Entity\Image;

class RecipeAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('createDate', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd H:m:s',
                'data'   => new \DateTime()
            ))
            ->add('name', 'text', array('label' => 'Name'))
            ->add('image', 'sonata_type_model', array('property' => 'name'))
            ->add('description', 'text', array('label' => 'Description'))
            ->add('rank', 'text', array('label' => 'Rank'))
            ->add('vote', 'text', array('label' => 'Vote'))
            ->add('recipeType', 'sonata_type_model', array('property' => 'name'))
            ->add('recipeTaste', 'sonata_type_model', array('property' => 'name'))
            ->add('ingredients', 'collection', array(
                'type'         => new IngredientType(),
                'allow_add'    => true,
                'allow_delete'    => true,
                'by_reference' => false,
            ))

        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            //->add('foto', null, array('template' => 'CocktailsRecipesBundle:List:path.html.twig'))
            ->add('description')
            ->add('rank')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
}
