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
            array('virgin-mojito-183x300.jpg', 'image-1', 'files/images/virgin-mojito-183x300.jpg.jpg'),
            array('zalias-skanumelis-218x300.jpg', 'image-2', 'files/images/zalias-skanumelis-218x300.jpg.jpg'),
            array('melyniu-ir-pieno-kokteilis-213x300.jpg', 'image-3', 'files/images/melyniu-ir-pieno-kokteilis-213x300.jpg.jpg'),
            array('arbuzu-ananasu-kokteilis-203x300.jpg', 'image-4', 'files/images/arbuzu-ananasu-kokteilis-203x300.jpg.jpg'),
            array('2sokoladinis-bananinis-pieno-kokteilis-201x300.jpg', 'image-5', 'files/images/sokoladinis-bananinis-pieno-kokteilis-201x300.jpg.jpg'),
            array('rail-splitter-230x300.jpg', 'image-6', 'files/images/rail-splitter-230x300.jpg.jpg'),
            array('braskine-pina-colada-232x300.jpg', 'image-7', 'files/images/braskine-pina-colada-232x300.jpg.jpg'),
            array('limonadas1-199x300.jpg', 'image-8', 'files/images/limonadas1-199x300.jpg.jpg'),
            array('2014-04-21_20-45_bananas1.jpeg', 'image-9', 'files/images/2014-04-21_20-45_bananas1.jpeg.jpeg'),
            array('2014-04-21_20-46_braske.jpg', 'image-10', 'files/images/2014-04-21_20-46_braske.jpg.jpeg'),
            array('sveik_kok', 'image-11', 'files/images/sveik_kok.jpg'),
            array('pieno_k', 'image-12', 'files/images/pieno_k.jpg'),
            array('4977', 'image-13', 'files/images/4977.jpg'),
            array('4968', 'image-14', 'files/images/4968.jpg'),
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