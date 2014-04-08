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
            array('recipe-1','ingredient-1'),
            array('recipe-2','ingredient-3'),
            array('recipe-1','ingredient-5'),
            array('recipe-4','ingredient-4'),
            array('recipe-3','ingredient-2'),
        );

        foreach($recipesIngredients as $r_s){
            $data = new RecipesIngredients();
            $data->setRecipe($this->getReference($r_s[0],$data));
            $data->setIngredient($this->getReference($r_s[1],$data));
            $data->setQuantity(1);
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
