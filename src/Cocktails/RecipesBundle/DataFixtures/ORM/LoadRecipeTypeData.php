<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Cocktails\RecipesBundle\Entity\RecipeType;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class RecipeTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $types = array(
            array("Gaivus", 'recipeType-1'),
            array("Vaisinis", 'recipeType-2'),
            array("Sokoladinis", 'recipeType-3'),
            array("Bananinis", 'recipeType-4'),
            array("Pieno", 'recipeType-5'),
            array("Braškinis", 'recipeType-6'),
        );

        foreach($types as $typeTemp){
            $type = new RecipeType();
            $type->setName($typeTemp[0]);
            $manager->persist($type);
            $this->addReference($typeTemp[1],$type);
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
        return 1;
    }
}
