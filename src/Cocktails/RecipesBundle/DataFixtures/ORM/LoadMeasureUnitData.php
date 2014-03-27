<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\MeasureUnit;

class MeasureUnitData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $measureUnit = new MeasureUnit();
        $measureUnit->setName('g');
        $manager->persist($measureUnit);
        $manager->flush();

        $measureUnit = null;

        $measureUnit = new MeasureUnit();
        $measureUnit->setName('ml');
        $manager->persist($measureUnit);
        $manager->flush();

        $measureUnit = null;

        $measureUnit = new MeasureUnit();
        $measureUnit->setName('vnt');
        $manager->persist($measureUnit);
        $manager->flush();

    }
}