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
            array('apelisnas', 'foto', 'measureUnit-3', 'ingredient-2', 'image-15'),
            array('cukrus', 'foto', 'measureUnit-1', 'ingredient-3', 'image-16'),
            array('ledai', 'foto', 'measureUnit-2', 'ingredient-4', 'image-17'),
            array('citrina', 'foto', 'measureUnit-3', 'ingredient-5', 'image-18'),
            array('ananasas', 'foto', 'measureUnit-3', 'ingredient-6', 'image-19'),
            array('mėtos lapeliai', 'foto', 'measureUnit-3', 'ingredient-7', 'image-20'),
            array('žaliųjų citrinų sultys', 'foto', 'measureUnit-2', 'ingredient-8', 'image-21'),
            array('imbiero limonadas', 'foto', 'measureUnit-2', 'ingredient-9', 'image-41'),
            array('ledo kubeliai', 'foto', 'measureUnit-3', 'ingredient-10', 'image-22'),
            array('žaliosios vynuogės', 'foto', 'measureUnit-4', 'ingredient-11', 'image-23'),
            array('ananasas', 'foto', 'measureUnit-3', 'ingredient-12', 'image-41'),
            array('špinatai', 'foto', 'measureUnit-4', 'ingredient-13', 'image-24'),
            array('medus', 'foto', 'measureUnit-5', 'ingredient-14', 'image-25'),
            array('vanduo', 'foto', 'measureUnit-2', 'ingredient-15', 'image-26'),
            array('mėlynės', 'foto', 'measureUnit-4', 'ingredient-16', 'image-27'),
            array('arbūzas', 'foto', 'measureUnit-4', 'ingredient-17', 'image-28'),
            array('šokolado sirupas', 'foto', 'measureUnit-2', 'ingredient-18', 'image-41'),
            array('bananų sulys', 'foto', 'measureUnit-2', 'ingredient-19', 'image-29'),
            array('citrinų sultys', 'foto', 'measureUnit-2', 'ingredient-20', 'image-30'),
            array('ananasų sultys', 'foto', 'measureUnit-2', 'ingredient-21', 'image-31'),
            array('kokosų grietinėlė', 'foto', 'measureUnit-2', 'ingredient-22', 'image-41'),
            array('grietinėlė', 'foto', 'measureUnit-2', 'ingredient-23', 'image-32'),
            array('braškės', '2014-04-21_20-46_braske.jpg.jpeg', 'measureUnit-3', 'ingredient-24', 'image-10'),
            array('cukraus sirupas', 'foto', 'measureUnit-2', 'ingredient-25', 'image-33'),
            array('apelsinų sultys', 'foto', 'measureUnit-2', 'ingredient-26', 'image-34'),
            array('grenadino sirupas', 'foto', 'measureUnit-5', 'ingredient-27', 'image-35'),
            array('kakava', 'foto', 'measureUnit-5', 'ingredient-28', 'image-36'),
            array('obuolių sultys', 'foto', 'measureUnit-2', 'ingredient-29', 'image-37'),
            array('riešutų sviestas', 'foto', 'measureUnit-1', 'ingredient-30', 'image-38'),
            array('šokoladas', 'foto', 'measureUnit-5', 'ingredient-31', 'image-39'),
            array('pienas', 'foto', 'measureUnit-2', 'ingredient-32', 'image-40'),
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