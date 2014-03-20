<?php

namespace Nfq\CocktailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NfqCocktailBundle:Default:index.html.twig', array('name' => $name));
    }
}
