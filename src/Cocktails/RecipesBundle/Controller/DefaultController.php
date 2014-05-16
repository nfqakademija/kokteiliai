<?php

namespace Cocktails\RecipesBundle\Controller;

use Cocktails\RecipesBundle\Entity\UsersRecipes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cocktails\RecipesBundle\Entity\Image;
use Cocktails\RecipesBundle\Entity\UsersIngredients;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\BrowserKit\Response;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        return $this->render('CocktailsRecipesBundle:Default:index.html.twig', array('name' => 'Index'));
        return $this->recipeTableAction();
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

    public function recipeTableAction()
    {
        $list = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:Recipe')->findAll();
        $tastes = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeTaste')->findAll();
        $types = $this->getDoctrine()->getRepository('CocktailsRecipesBundle:RecipeType')->findAll();
        $fbCount = $this->getRecipesCount($list);

        return $this->render('CocktailsRecipesBundle:List:recipeTable.html.twig', array('list' => $list, 'tastes' => $tastes, 'types' => $types, 'fbCount' => $fbCount));
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
