<?php
/**
 * Created by PhpStorm.
 * User: Audrius
 * Date: 14.4.5
 * Time: 19.50
 */

namespace Cocktails\RecipesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cocktails\RecipesBundle\Entity\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends Controller
{
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
}
