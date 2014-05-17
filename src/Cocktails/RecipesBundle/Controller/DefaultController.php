<?php

namespace Cocktails\RecipesBundle\Controller;

use Cocktails\RecipesBundle\Entity\UsersRecipes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cocktails\RecipesBundle\Entity\Image;
use Cocktails\RecipesBundle\Entity\UsersIngredients;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
//        return $this->render('CocktailsRecipesBundle:Default:index.html.twig', array('name' => 'Index'));
        return $this->recipeTableAction($request);
    }

    public function menuAction()
    {
        return $this->render('CocktailsRecipesBundle:Default:menu.html.twig');
    }

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
        }

        return array('form' => $form->createView());
    }

    public function recipeTableAction(Request $request)
    {
        $sess = $request->getSession();
        //$sess->set("vardas","test");

        $userIngredients =  "";

        $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
        $tastes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeTaste')->findAll();
        $types = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeType')->findAll();
        $fbCount = $this->getRecipesCount($list);
        $ingredient = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->findAll();

        if($this->getUser())
            $userIngredients =  $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->getUserIngredients($this->getUser()->getId());

        $paginator  = $this->get('knp_paginator');
        $pag = $paginator->paginate(
            $list,
            $this->get('request')->query->get('page', 1),
            10
        );

        return $this->render('CocktailsRecipesBundle:List:recipeTable.html.twig', array('list' => $pag, 'tastes' => $tastes, 'types' => $types, 'fbCount' => $fbCount, 'ingredients' => $ingredient, 'userIngredients' => $userIngredients));
    }
    public function updateDataAction(Request $request){

        $data = trim($request->get('data'));
        $type = trim($request->get('type'));


        //$aa = $request->getSession();
        //echo $aa->get("vardas");

        $list = "";

        if($type === "type" || $type === "taste"){
            $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->getFilteredRecipes($data, $type);
        }
        elseif($type === "ingredients"){
            $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipesIngredients')->getFilterIngredients($data);
        }elseif($type === "myIngredients"){
            $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipesIngredients')->getFilterIngredients($data);
        }
        $fbCount = $this->getRecipesCount($list);

        $paginator  = $this->get('knp_paginator');
        $list = $paginator->paginate(
            $list,
            $this->get('request')->query->get('page', 1),
            10
        );

        return $this->render('CocktailsRecipesBundle:List:recipeList.html.twig', array('list' => $list, 'fbCount' => $fbCount));
    }

    /**
     * About page
     *
     * @return Response
     */
    public function aboutAction()
    {
        return $this->render('CocktailsRecipesBundle:Default:about.html.twig');
    }

    /**
     * Count fb like
     *
     * @param $url_or_id
     * @return int
     */
    public function shinra_fb_count( $url_or_id ) {
        /* url or id (for optional validation) */
        if( is_int( $url_or_id ) ) $url = 'http://graph.facebook.com/' . $url_or_id;
        else $url = 'http://graph.facebook.com/' .  $url_or_id;

        /* get json */
        $json = json_decode( file_get_contents( $url ), false );

        /* has likes or shares? */
        if( isset( $json->likes ) ) return (int) $json->likes;
        elseif( isset( $json->shares ) ) return (int) $json->shares;

        return 0; // otherwise zed
    }

    public function getRecipesCount($recipes){
        $fbCount = array();
        foreach($recipes as $recipe)
            $fbCount[] = $this->shinra_fb_count('http://kokteiliai.projektai.nfqakademija.lt/Recipe/'.$recipe->getId());

        return $fbCount;
    }

    public function checkIfAddedAction(Request $request){
        $id = $request->get('id');
        $recipe = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->find($id);
        $user = $this->getUser();
        if ($this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->findOneBy(array('user'=>$user, 'recipe'=>$recipe)))
        {
            return new Response('true');
        } else {
            return new Response('false');
        }

    }
}
