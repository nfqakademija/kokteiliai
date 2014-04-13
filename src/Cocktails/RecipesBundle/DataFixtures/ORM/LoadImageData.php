<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\Image;

class LoadImageData  extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $imageData = array(
            array('2014-04-08_21-39_flag.png', 'image-1', 'files/images/2014-04-08_21-39_flag.png.png'),
            array('2014-04-08_17-32_cir.png', 'image-2', 'files/images/2014-04-08_17-32_cir.png.png'),
            array('2014-04-08_17-40_apie_logo_min.png', 'image-3', 'files/images/2014-04-08_17-40_apie_logo_min.png.png'),
        );

        foreach($imageData as $data){
            $image = new Image();
            $image->setName($data[0]);
            $image->setPath($data[2]);
            $manager->persist($image);
            $this->addReference($data[1], $image);
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