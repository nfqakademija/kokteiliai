<?php

namespace Cocktails\RecipesBundle\Controller;

use Cocktails\RecipesBundle\Entity\UsersRecipes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cocktails\RecipesBundle\Entity\Image;
use Cocktails\RecipesBundle\Entity\UsersIngredients;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ButtonController extends Controller
{
    public function removeRecipeFromUserAction(Request $request){
        $id = $request->get('id');
        $recipe = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($recipe);
        $em->flush();

        return $this->render('CocktailsRecipesBundle:Default:index.html.twig');
    }

    public function addRecipeToUserAction(Request $request){
        $usr = $this->getUser();
        $recipeId = $request->get('id');
        $recipe = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->find($recipeId);
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

        return $this->render('CocktailsRecipesBundle:Default:index.html.twig');
    }

    public function addIngredientToUserAction(Request $request){
        $usr = $this->getUser();
        $id = $request->get('ingredient');
        $ingredient = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->find($id);
        $quantity = $request->get('quantity');
        $em = $this->getDoctrine()->getManager();
        if($this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('ingredient'=>$ingredient)))
        {
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
        return $this->render('CocktailsRecipesBundle:Default:index.html.twig');
    }

}