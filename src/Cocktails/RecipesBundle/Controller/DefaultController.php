<?php

namespace Cocktails\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cocktails\RecipesBundle\Entity\Image;
use Cocktails\RecipesBundle\Entity\UsersIngredients;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Response;
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
        $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();      return $this->render('CocktailsRecipesBundle:Default:recipesWindow.html.twig', array('list' => $list));
    }

    public function tasteSortAction()
    {   $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
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
        $usr= $this->getUser()->getId();
        $ingredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->findAll();
        $userIngredients = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->findBy(array('user'=>$usr));
        return $this->render('CocktailsRecipesBundle:Default:myProductsWindow.html.twig', array('ingredients'=>$ingredients, 'userIngredients'=>$userIngredients));
    }

    public function addIngredientToUserAction(Request $request){
        $usr= $this->getUser();
        $id = $request->get('ingredient');
        $ingredientEntity = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Ingredient')->find($id);
        $quantity = $request->get('quantity');

        $UsrIngr = new UsersIngredients();
        $UsrIngr->setQuantity($quantity);
        $UsrIngr->setUser($usr);
        $UsrIngr->setIngredient($ingredientEntity);

        $em = $this->getDoctrine()->getManager();
        $em->persist($UsrIngr);
        $em->flush();

       // $usr->addIngredient($ingredientEntity);

        var_dump($_GET, $_POST, $_REQUEST, $id, $quantity);

        return $this->render('CocktailsRecipesBundle:Default:menu.html.twig');
    }

    public function removeIngredientFromUserAction(Request $request){
        $usr= $this->getUser();
        $id = $request->get('ingredient');
        $ingredientEntity = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:UsersIngredients')->find($id);
        //$usr->removeIngredient($ingredientEntity);

        $em = $this->getDoctrine()->getManager();
        $em->remove($ingredientEntity);
        $em->flush();

        var_dump($id);
        return $this->render('CocktailsRecipesBundle:Default:menu.html.twig');
    }
}
