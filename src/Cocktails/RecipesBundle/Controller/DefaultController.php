<?php

namespace Cocktails\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CocktailsRecipesBundle:Default:index.html.twig', array('name' => $name));
    }
}
