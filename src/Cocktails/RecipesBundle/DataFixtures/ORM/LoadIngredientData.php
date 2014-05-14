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
            array('mėtos lapeliai', 'foto', 'measureUnit-3', 'ingredient-7'),
            array('žaliųjų citrinų sultys', 'foto', 'measureUnit-2', 'ingredient-8'),
            array('imbiero limonadas', 'foto', 'measureUnit-2', 'ingredient-9'),
            array('ledo kubeliai', 'foto', 'measureUnit-3', 'ingredient-10'),
            array('žaliosios vynuogės', 'foto', 'measureUnit-4', 'ingredient-11'),
            array('ananasas', 'foto', 'measureUnit-3', 'ingredient-12'),
            array('špinatos', 'foto', 'measureUnit-4', 'ingredient-13'),
            array('medus', 'foto', 'measureUnit-5', 'ingredient-14'),
            array('vanduo', 'foto', 'measureUnit-2', 'ingredient-15'),
            array('mėlynės', 'foto', 'measureUnit-4', 'ingredient-16'),
            array('arbūzas', 'foto', 'measureUnit-4', 'ingredient-17'),
            array('šokolado sirupas', 'foto', 'measureUnit-2', 'ingredient-18'),
            array('bananų sulys', 'foto', 'measureUnit-2', 'ingredient-19'),
            array('citrinų sultys', 'foto', 'measureUnit-2', 'ingredient-20'),
            array('ananasų sultys', 'foto', 'measureUnit-2', 'ingredient-21'),
            array('kokosų grietinėlė', 'foto', 'measureUnit-2', 'ingredient-22'),
            array('grietinėlė', 'foto', 'measureUnit-2', 'ingredient-23'),
            array('braškės', 'foto', 'measureUnit-3', 'ingredient-24'),
            array('cukraus sirupas', 'foto', 'measureUnit-2', 'ingredient-25'),
            array('pienas', 'foto', 'measureUnit-2', 'ingredient-26'),
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