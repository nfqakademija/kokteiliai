<?php

namespace Cocktails\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cocktails\RecipesBundle\Entity\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CocktailsRecipesBundle:Default:index.html.twig', array('name' => 'Index'));
    }

    public function listAction()
    {
        $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Measureunit')->findAll();

        return $this->render('CocktailsRecipesBundle:Default:list.html.twig', array('list' => $list));
    }
    public function headerAction()
    {
        return $this->render('CocktailsRecipesBundle:Default:header.html.twig');
    }

    public function menuAction()
    {
        return $this->render('CocktailsRecipesBundle:Default:menu.html.twig');
    }

    /**
     * @Template()
     */
    public function uploadAction(Request $request)
    {
        $image = new Image();
        $form = $this->createFormBuilder($image)
            ->add('name')
            ->add('file')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $image->upload();

            $em->persist($image);
            $em->flush();

            #return $this->redirect('kokteiliai/web/files/images');
        }

        return array('form' => $form->createView());
    }

    public function recipeTableAction()
    {
        $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
        return $this->render('CocktailsRecipesBundle:List:recipeTable.html.twig', array('list' => $list));
    }
}
