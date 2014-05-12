<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\RecipesIngredients;

class LoadRecipesIngtedientsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $recipesIngredients = array(
            array('recipe-1','ingredient-7','10'),
            array('recipe-1','ingredient-3','10'),
            array('recipe-1','ingredient-8','30'),
            array('recipe-1','ingredient-25','15'),
            array('recipe-1','ingredient-9','120'),

            array('recipe-2','ingredient-11', '1'),
            array('recipe-2','ingredient-1', '0.5'),
            array('recipe-2','ingredient-6', '0.5'),
            array('recipe-2','ingredient-13', '2'),
            array('recipe-2','ingredient-14', '2'),
            array('recipe-2','ingredient-15', '100'),
            array('recipe-2','ingredient-10', '5'),

            array('recipe-3','ingredient-16', '1'),
            array('recipe-3','ingredient-26', '400'),
            array('recipe-3','ingredient-3', '30'),

            array('recipe-4','ingredient-6', '0.1'),
            array('recipe-4','ingredient-17', '0.2'),
            array('recipe-4','ingredient-10', '5'),

            array('recipe-5','ingredient-18', '30'),
            array('recipe-5','ingredient-19', '20'),
            array('recipe-5','ingredient-26', '150'),

            array('recipe-6','ingredient-25', '200'),
            array('recipe-6','ingredient-20', '100'),
            array('recipe-6','ingredient-9', '100'),

            array('recipe-7','ingredient-21', '60'),
            array('recipe-7','ingredient-22', '30'),
            array('recipe-7','ingredient-23', '30'),
            array('recipe-7','ingredient-24', '8'),
            array('recipe-7','ingredient-10', '3'),

            array('recipe-8','ingredient-20', '250'),
            array('recipe-8','ingredient-25', '250'),
            array('recipe-8','ingredient-15', '1000'),
            array('recipe-8','ingredient-7', '10'),
        );

        foreach($recipesIngredients as $r_s){
            $data = new RecipesIngredients();
            $data->setRecipe($this->getReference($r_s[0],$data));
            $data->setIngredient($this->getReference($r_s[1],$data));
            $data->setQuantity($r_s[2]);
            $manager->persist($data);
        }
        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 4;
    }
}