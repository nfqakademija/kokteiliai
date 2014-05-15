<?php

namespace Cocktails\RecipesBundle\Controller;

use Cocktails\RecipesBundle\Entity\RecipesIngredients;
use Cocktails\RecipesBundle\Entity\UsersRecipes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cocktails\RecipesBundle\Entity\Image;
use Cocktails\RecipesBundle\Entity\UsersIngredients;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NavigationController extends Controller
{
    public function myRecipesAction(){
        if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            $usr = $this->getUser()->getId();
            $recipes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->findBy(array('user'=>$usr));
            return $this->render('CocktailsRecipesBundle:Default:myRecipesWindow.html.twig', array('recipes'=>$recipes));
        } else {return $this->render('CocktailsRecipesBundle:Default:index.html.twig', array('name' => 'Index'));}
    }

    public function myProductsAction(){
        if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            $usr = $this->getUser()->getId();
            $ingredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->findAll();
            $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));
            return $this->render('CocktailsRecipesBundle:Default:myProductsWindow.html.twig', array('ingredients'=>$ingredients, 'userIngredients'=>$userIngredients));
        } else {return $this->render('CocktailsRecipesBundle:Default:index.html.twig', array('name' => 'Index'));}
    }

    public function showRecipeAction($id){
        $recipe = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->find($id);
        $ingredientsNeeded = array();
        $ingredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipesIngredients')->findBy(array('recipe'=>$recipe->getId()));
        if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            $usr = $this->getUser()->getId();
            $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));
            foreach ($ingredients as $ingredient){
                $quantity = $ingredient->getQuantity();
                $IngrNeeded = array('name'=>$ingredient->getIngredient()->getName(),
                    'quantity'=>$quantity,
                    'measureUnit'=>$ingredient->getIngredient()->getMeasureUnit()->getName()
                );
                foreach ($userIngredients as $userIngredient){
                    if ($ingredient->getIngredient() == $userIngredient->getIngredient()){
                        $quantity = $ingredient->getQuantity() - $userIngredient->getQuantity();
                        $IngrNeeded['quantity'] = $quantity;
                    }
                }
                if ($quantity > 0){
                    $ingredientsNeeded[] = $IngrNeeded;
                }
            }
        }
        return $this->render('CocktailsRecipesBundle:Default:recipeSingleWindow.html.twig', array('recipe'=>$recipe, 'ingredients'=>$ingredients, 'ingredientsNeeded'=>$ingredientsNeeded));
    }

    public function typeSortAction()
    {   $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
        $types = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeType')->findAll();
        return $this->render('CocktailsRecipesBundle:Default:typeWindow.html.twig', array('types'=>$types, 'list' => $list));
    }

    public function tasteSortAction()
    {   $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
        $tastes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeTaste')->findAll();
        return $this->render('CocktailsRecipesBundle:Default:tasteWindow.html.twig', array('tastes'=>$tastes, 'list' => $list));
    }
}