<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Cocktails\RecipesBundle\Entity\RecipeTaste;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\MeasureUnit;

class RecipeTasteData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $recipeTaste = new RecipeTaste();
        $recipeTaste->setName('Šokoladinis');
        $manager->persist($recipeTaste);
        $manager->flush();

        $recipeTaste = null;

        $recipeTaste = new RecipeTaste();
        $recipeTaste->setName('Bananinis');
        $manager->persist($recipeTaste);
        $manager->flush();

        $recipeTaste = null;

        $recipeTaste = new RecipeTaste();
        $recipeTaste->setName('Braškinis');
        $manager->persist($recipeTaste);
        $manager->flush();

    }
}
