<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\Ingredient;

class LoadIngredientData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $ingredients = array(
            array('bananas', 'foto', 'measureUnit-3', 'ingredient-1'),
            array('apelisnas', 'foto', 'measureUnit-3', 'ingredient-2'),
            array('cukrus', 'foto', 'measureUnit-1', 'ingredient-3'),
            array('ledai', 'foto', 'measureUnit-2', 'ingredient-4'),
            array('citrina', 'foto', 'measureUnit-3', 'ingredient-5'),
            array('ananasas', 'foto', 'measureUnit-3', 'ingredient-6'),
        );

        foreach($ingredients as $ingredient){
            $data = new Ingredient();
            $data->setName($ingredient[0]);
            $data->setFoto($ingredient[1]);
            $manager->persist($data);
            $data->setMeasureUnit($this->getReference($ingredient[2]));
            $this->addReference($ingredient[3],$data);
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
        return 2;
    }
}