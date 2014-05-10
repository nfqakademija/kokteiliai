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

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CocktailsRecipesBundle:Default:index.html.twig', array('name' => 'Index'));
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
        $tastes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeTaste')->findAll();
        $types = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeType')->findAll();
        return $this->render('CocktailsRecipesBundle:Default:recipesWindow.html.twig', array('list' => $list, 'tastes' => $tastes, 'types' => $types));
    }

    public function tasteSortAction(Request $request)
    {
       // print_r($request);
        //echo $request->query->get("filt");
        //echo $request->
        $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
        $tastes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeTaste')->findAll();
        return $this->render('CocktailsRecipesBundle:Default:tasteWindow.html.twig', array('tastes'=>$tastes, 'list' => $list));
    }

    public function typeSortAction()
    {   $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
        $types = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeType')->findAll();
        return $this->render('CocktailsRecipesBundle:Default:typeWindow.html.twig', array('types'=>$types, 'list' => $list));
    }

    public function showRecipeAction($id){
        $recipe = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->find($id);
        if (!$recipe) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('CocktailsRecipesBundle:Default:recipeSingleWindow.html.twig', array('recipe'=>$recipe));
    }

    public function myProductsAction(){
        //TODO: patikrinti ar prisijunges
        $usr = $this->getUser()->getId();
        $ingredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->findAll();
        $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));
        return $this->render('CocktailsRecipesBundle:Default:myProductsWindow.html.twig', array('ingredients'=>$ingredients, 'userIngredients'=>$userIngredients));
    }

    public function myRecipesAction(){
        //TODO: patikrinti ar prisijunges
        $usr = $this->getUser()->getId();
        $recipes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->findBy(array('user'=>$usr));

        return $this->render('CocktailsRecipesBundle:Default:myRecipesWindow.html.twig', array('recipes'=>$recipes));
    }

    public function addIngredientToUserAction(Request $request){
        $usr = $this->getUser();
        $id = $request->get('ingredient');
        $ingredient = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->find($id);
        $quantity = $request->get('quantity');

        $usrIngr = new UsersIngredients();
        $usrIngr->setQuantity($quantity);
        $usrIngr->setUser($usr);
        $usrIngr->setIngredient($ingredient);

        $em = $this->getDoctrine()->getManager();
        $em->persist($usrIngr);
        $em->flush();

        return $this->render('CocktailsRecipesBundle:Default:menu.html.twig');
    }

    public function removeIngredientFromUserAction(Request $request){
        $id = $request->get('ingredient');
        $ingredient = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($ingredient);
        $em->flush();

        return $this->render('CocktailsRecipesBundle:Default:menu.html.twig');
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

        return $this->render('CocktailsRecipesBundle:Default:menu.html.twig');
    }

    public function removeRecipeFromUserAction(Request $request){
        $id = $request->get('id');
        $recipe = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersRecipes')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($recipe);
        $em->flush();

        return $this->render('CocktailsRecipesBundle:Default:menu.html.twig');
    }

    public function updateDataAction(Request $request){

        //$request = $this->container->get('request');
        $data1 = $request->get('data1');
        $data2 = $request->get('data2');
        //prepare the response, e.g.

        //$response = array("code" => 100, "success" => true, "data1" => $data1);
        //you can return result as JSON
        //return new Response(json_encode($response));
        $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
        return $this->render('CocktailsRecipesBundle:List:recipeList.html.twig', array('list' => $list));
    }
}
