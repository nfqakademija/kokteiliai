<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\MeasureUnit;

class LoadMeasureUnitData  extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $measureUnits = array(
            array('g', 'measureUnit-1'),
            array('ml', 'measureUnit-2'),
            array('vnt', 'measureUnit-3'),
        );

        foreach($measureUnits as $measureUnit){
            $measureUnitData = new MeasureUnit();
            $measureUnitData->setName($measureUnit[0]);
            $manager->persist($measureUnitData);
            $this->addReference($measureUnit[1], $measureUnitData);
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
        return 0;
    }
}