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
            $ingredientsNeeded = array();
            $usr = $this->getUser()->getId();
            $recipes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->findBy(array('user'=>$usr));
            foreach ($recipes as $recipe)
            {
                $ingredientsNeeded = $this->ingredientsNeeded($recipe->getRecipe()->getId(), $ingredientsNeeded);
            }
            $ingredientsNeeded = $this->subtractUserIngr($ingredientsNeeded);
            return $this->render('CocktailsRecipesBundle:Default:myRecipesWindow.html.twig', array('recipes'=>$recipes, 'ingredientsNeeded'=>$ingredientsNeeded));
        } else {return $this->render('CocktailsRecipesBundle:Default:index.html.twig', array('name' => 'Index'));}
    }

    private function ingredientsNeeded($recipe, $list)
    {
        $ingredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipesIngredients')->findBy(array('recipe'=>$recipe));
        foreach ($ingredients as $ingredient){
            $added = false;
            $quantity = $ingredient->getQuantity();
            $ingrNeeded = array(
                'id'=>$ingredient->getIngredient()->getId(),
                'name'=>$ingredient->getIngredient()->getName(),
                'quantity'=>$quantity,
                'measureUnit'=>$ingredient->getIngredient()->getMeasureUnit()->getName()
            );
            foreach($list as &$listElement)
            {
                if ($listElement['id'] == $ingrNeeded['id'])
                {
                    $listElement['quantity'] += $ingrNeeded['quantity'];
                    $added = true;
                }
            }
            if ((!$added) and ($ingrNeeded['quantity'] > 0)){
                $list[] = $ingrNeeded;
            }
        }
        return $list;
    }

    private function subtractUserIngr($list)
    {
        $usr = $this->getUser()->getId();
        $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));
        foreach($list as $key =>&$listElement)
        {
            foreach($userIngredients as $userIngredient)
            {
                if($listElement['id'] == $userIngredient->getIngredient()->getId())
                {
                    if ($listElement['quantity']-$userIngredient->getQuantity() <= 0)
                    {
                        unset($list[$key]);
                    } else {
                        $listElement['quantity'] -= $userIngredient->getQuantity();
                    }

                }
            }
        }
        return $list;
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

        $added = false;
        $ingredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipesIngredients')->findBy(array('recipe'=>$recipe->getId()));
        if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            $usr = $this->getUser()->getId();
            if($this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->findOneBy(array('recipe'=>$id, 'user'=>$usr)))
            {
                $added = true;

            }
            $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));
            foreach ($ingredients as $ingredient){
                $quantity = $ingredient->getQuantity();
                $IngrNeeded = array(
                    'id'=>$ingredient->getIngredient()->getId(),
                    'name'=>$ingredient->getIngredient()->getName(),
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
        return $this->render('CocktailsRecipesBundle:Default:recipeSingleWindow.html.twig', array('recipe'=>$recipe, 'ingredients'=>$ingredients, 'ingredientsNeeded'=>$ingredientsNeeded, 'added'=>$added));
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