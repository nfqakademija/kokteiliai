<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Cocktails\RecipesBundle\Entity\RecipeType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\MeasureUnit;

class RecipeTypeData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $recipeType = new RecipeType();
        $recipeType->setName('Saldus');
        $manager->persist($recipeType);
        $manager->flush();

        $recipeTaste = null;

        $recipeType = new RecipeType();
        $recipeType->setName('Rūgštus');
        $manager->persist($recipeType);
        $manager->flush();

        $recipeTaste = null;

        $recipeType = new RecipeType();
        $recipeType->setName('Kartus');
        $manager->persist($recipeType);
        $manager->flush();

    }
}
