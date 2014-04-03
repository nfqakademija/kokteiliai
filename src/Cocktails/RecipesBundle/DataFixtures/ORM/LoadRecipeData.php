<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\Recipe;

class LoadRecipeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $recipes = array(
            array('Geltonoji uoga', 20, 'recipeType-1', 'foto','recipe-1'),
            array('Vaisinis kokteilis', 15, 'recipeType-2', 'foto', 'recipe-2'),
            array('Apelsinu - bananu', 7, 'recipeType-2', 'foto', 'recipe-3'),
            array('Vaikyste', 35, 'recipeType-3', 'foto', 'recipe-4'),
        );

        foreach($recipes as $recipeTemp){

            $recipe = new Recipe();
            $recipe->setName($recipeTemp[0]);
            $recipe->setRank($recipeTemp[1]);
            $recipe->setRecipeType($this->getReference($recipeTemp[2]));
            $recipe->setFoto($recipeTemp[3]);
            $manager->persist($recipe);
            $this->addReference($recipeTemp[4],$recipe);
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
        return 3;
    }
}