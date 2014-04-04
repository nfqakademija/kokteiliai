<?php
namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\Taste;

class LoadTasteData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $tastes = array(
            array("Saldus", 'taste-1'),
            array("Rugstus", 'taste-2'),
            array("Kartus", 'taste-3'),
            array("Neutralus", 'taste-4'),
        );

        foreach($tastes as $t){
            $tasteData = new Taste();
            $tasteData->setName($t[0]);
            $manager->persist($tasteData);
            $this->addReference($t[1], $tasteData);
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