<?php

namespace Cocktails\RecipesBundle\Controller;

use Cocktails\RecipesBundle\Entity\UsersRecipes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cocktails\RecipesBundle\Entity\UsersIngredients;
use Symfony\Component\HttpFoundation\Request;

class ButtonController extends Controller
{
    public function removeRecipeFromUserAction(Request $request){
        $id = $request->get('id');
        $recipe = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($recipe);
        $em->flush();

        $usr = $this->getUser();
        $recipes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->findBy(array('user'=>$usr));

        $response = $this->forward('CocktailsRecipesBundle:Navigation:recipeTable');

        return $response;
    }

    public function addRecipeToUserAction(Request $request){
        $usr = $this->getUser();
        $recipeId = $request->get('id');
        $recipe = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->find($recipeId);
        $recipe->incRank();
        $usrRecipe = new UsersRecipes();
        $usrRecipe->setUser($usr);
        $usrRecipe->setRecipe($recipe);
        $em = $this->getDoctrine()->getManager();
        $em->persist($usrRecipe);
        $em->flush();

        return $this->render('CocktailsRecipesBundle:Default:index.html.twig');
    }

    public function removeIngredientFromUserAction(Request $request){
        $id = $request->get('ingredient');
        $ingredient = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($ingredient);
        $em->flush();

        $usr = $this->getUser();
        $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));
        return $this->render('CocktailsRecipesBundle:List:UserIngredientTable.html.twig', array( 'userIngredients'=>$userIngredients));
    }

    public function updateIngredientAction(Request $request){
        $usr = $this->getUser();
        $id = $request->get('ingredient');
        $quantity = $request->get('quantity');
        $em = $this->getDoctrine()->getManager();
        $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findOneBy(array('id'=>$id, 'user'=>$usr))->setQuantity($quantity);
        $em->flush();
        $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));
        return $this->render('CocktailsRecipesBundle:List:UserIngredientTable.html.twig', array( 'userIngredients'=>$userIngredients));
    }

    public function addIngredientToUserAction(Request $request){
        $usr = $this->getUser();
        $id = $request->get('ingredient');
        $ingredient = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->find($id);
        $quantity = $request->get('quantity');
        $em = $this->getDoctrine()->getManager();
        if($this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findOneBy(array('ingredient'=>$ingredient, 'user'=>$usr)))
        {
            $quantity += $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findOneBy(array('ingredient'=>$ingredient, 'user'=>$usr))->getQuantity();
            $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findOneBy(array('ingredient'=>$ingredient, 'user'=>$usr))->setQuantity($quantity);
            $em->flush();
        } else
        {
            $usrIngr = new UsersIngredients();
            $usrIngr->setQuantity($quantity);
            $usrIngr->setUser($usr);
            $usrIngr->setIngredient($ingredient);
            $em->persist($usrIngr);
            $em->flush();
        }
        $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));;
        return $this->render('CocktailsRecipesBundle:List:UserIngredientTable.html.twig', array( 'userIngredients'=>$userIngredients));
    }

    public function ingredientSearchAction(Request $request)
    {
        $name = $request->get('name');
        $ingredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->findAll();
        foreach($ingredients as $key=>$ingredient)
        {

            if (strpos($ingredient->getName(), $name) !== false)
            {} else {
                unset($ingredients[$key]);
            }
        }
        return $this->render('CocktailsRecipesBundle:List:productTable.html.twig', array( 'ingredients'=>$ingredients));
    }

}