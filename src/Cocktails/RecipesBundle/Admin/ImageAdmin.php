<?php
/**
 * Created by PhpStorm.
 * User: Audrius
 * Date: 14.3.29
 * Time: 12.47
 */

namespace Cocktails\RecipesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class ImageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current Image instance
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image && ($webPath = $image->getWebPath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath().'/'.$webPath;
            $testPath = $image->getPath();
            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="'.$testPath.'" class="admin-preview" />';
        }

        $formMapper
            ->add('file', 'file', $fileFieldOptions)
            ->add('name', 'text', array('label' => 'Name'))

            // ... other fields can go here ...
        ;
    }

    public function prePersist($image) {
        $this->manageFileUpload($image);
    }

    public function preUpdate($image) {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image) {
        if ($image->getFile()) {
            $image->refreshUpdated();
        }
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
        $test = "<img src='".'path'."' />";
        $listMapper
            ->addIdentifier('name')
            ->add('path', null, array('template' => 'CocktailsRecipesBundle:List:path.html.twig'))
            ->addIdentifier($test)
        ;
    }
}