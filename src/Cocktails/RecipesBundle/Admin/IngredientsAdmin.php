<?php

namespace Cocktails\RecipesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Cocktails\RecipesBundle\Entity\Measureunits;
use Cocktails\RecipesBundle\Entity\MeasureunitsRepository;

class IngredientsAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $unitsRepository = $em->getRepository('CocktailsRecipesBundle:Measureunits');
        $unitList = $unitsRepository->get_measureunits_by_property();

        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('foto', 'text', array('label' => 'Foto'))
            ->add('measure_unit_id', 'choice', array('choices' => $unitList))
        ;
    }

    #->add('measure_unit_id', 'entity', array('class' => 'Cocktails\RecipesBundle\Entity\Measureunits', 'property' => 'name'))
    #->add('measure_unit_id', 'sonata_type_model', array('class' => 'Cocktails\RecipesBundle\Entity\Measureunits'))

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
            ->add('foto')
        ;
    }
}