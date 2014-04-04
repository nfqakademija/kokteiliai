<?php

namespace Cocktails\RecipesBundle\Admin;

use Cocktails\RecipesBundle\Form\IngredientType;
use Proxies\__CG__\Cocktails\RecipesBundle\Entity\Recipe;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RecipeAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('foto', 'text', array('label' => 'Foto'))
            ->add('rank', 'text', array('label' => 'Rank'))
            ->add('recipeType', 'sonata_type_model', array('property' => 'name'))
            ->add('recipeTaste', 'sonata_type_model', array('property' => 'name'))
            ->add('ingredients', 'collection', array(
                'type'         => new IngredientType($this->getSubject()),
                'allow_add'    => true,
            ))

        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            #->add('name')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('foto')
            ->add('rank')
        ;
    }
}
