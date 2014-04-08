<?php

namespace Cocktails\RecipesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RecipesIngredientsAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('recipe', 'sonata_type_model', array('property' => 'name'))
            ->add('ingredient', 'sonata_type_model', array('property' => 'name'))
            ->add('quantity', 'text', array('data' => 1))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            #->add('name')
            #->add('rank')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            #->addIdentifier('name')
            #->add('foto')
            #->add('rank')
        ;
    }
}
