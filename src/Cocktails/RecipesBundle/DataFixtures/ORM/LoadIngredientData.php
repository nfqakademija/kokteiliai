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
            array('bananas', '2014-04-21_20-45_bananas1.jpeg.jpeg', 'measureUnit-3', 'ingredient-1', 'image-9'),
            array('apelisnas', 'foto', 'measureUnit-3', 'ingredient-2', 'image-9'),
            array('cukrus', 'foto', 'measureUnit-1', 'ingredient-3', 'image-9'),
            array('ledai', 'foto', 'measureUnit-2', 'ingredient-4', 'image-9'),
            array('citrina', 'foto', 'measureUnit-3', 'ingredient-5', 'image-9'),
            array('ananasas', 'foto', 'measureUnit-3', 'ingredient-6', 'image-9'),
            array('mėtos lapeliai', 'foto', 'measureUnit-3', 'ingredient-7', 'image-9'),
            array('žaliųjų citrinų sultys', 'foto', 'measureUnit-2', 'ingredient-8', 'image-9'),
            array('imbiero limonadas', 'foto', 'measureUnit-2', 'ingredient-9', 'image-9'),
            array('ledo kubeliai', 'foto', 'measureUnit-3', 'ingredient-10', 'image-9'),
            array('žaliosios vynuogės', 'foto', 'measureUnit-4', 'ingredient-11', 'image-9'),
            array('ananasas', 'foto', 'measureUnit-3', 'ingredient-12', 'image-9'),
            array('špinatos', 'foto', 'measureUnit-4', 'ingredient-13', 'image-9'),
            array('medus', 'foto', 'measureUnit-5', 'ingredient-14', 'image-9'),
            array('vanduo', 'foto', 'measureUnit-2', 'ingredient-15', 'image-9'),
            array('mėlynės', 'foto', 'measureUnit-4', 'ingredient-16', 'image-9'),
            array('arbūzas', 'foto', 'measureUnit-4', 'ingredient-17', 'image-9'),
            array('šokolado sirupas', 'foto', 'measureUnit-2', 'ingredient-18', 'image-9'),
            array('bananų sulys', 'foto', 'measureUnit-2', 'ingredient-19', 'image-9'),
            array('citrinų sultys', 'foto', 'measureUnit-2', 'ingredient-20', 'image-9'),
            array('ananasų sultys', 'foto', 'measureUnit-2', 'ingredient-21', 'image-9'),
            array('kokosų grietinėlė', 'foto', 'measureUnit-2', 'ingredient-22', 'image-9'),
            array('grietinėlė', 'foto', 'measureUnit-2', 'ingredient-23', 'image-9'),
            array('braškės', '2014-04-21_20-46_braske.jpg.jpeg', 'measureUnit-3', 'ingredient-24', 'image-10'),
            array('cukraus sirupas', 'foto', 'measureUnit-2', 'ingredient-25', 'image-9'),
            array('pienas', 'foto', 'measureUnit-2', 'ingredient-26', 'image-9'),
        );

        foreach($ingredients as $ingredient){
            $data = new Ingredient();
            $data->setName($ingredient[0]);
            $data->setFoto($ingredient[1]);
            $manager->persist($data);
            $data->setMeasureUnit($this->getReference($ingredient[2]));
            $data->setImage($this->getReference($ingredient[4]));
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