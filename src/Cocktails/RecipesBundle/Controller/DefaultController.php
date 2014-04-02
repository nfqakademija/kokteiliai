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

            return $this->redirect('/kokteiliai/1');
        }

        return array('form' => $form->createView());
    }
}
