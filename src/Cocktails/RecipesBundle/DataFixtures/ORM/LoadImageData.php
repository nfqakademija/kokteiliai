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
            array('apelsin', 'image-15', 'files/images/apelsin.jpg'),
            array('cukrus', 'image-16', 'files/images/cukrus.jpg'),
            array('ledai', 'image-17', 'files/images/ledai.jpg'),
            array('citrina', 'image-18', 'files/images/citrina.jpg'),
            array('ananasas', 'image-19', 'files/images/ananasas.jpg'),
            array('meta', 'image-20', 'files/images/meta.jpg'),
            array('al_citr_sult', 'image-21', 'files/images/al_citr_sult.jpg'),
            array('kub', 'image-22', 'files/images/kub.jpg'),
            array('zal_vyn', 'image-23', 'files/images/zal_vyn.jpg'),
            array('spin', 'image-24', 'files/images/spin.jpg'),
            array('medus', 'image-25', 'files/images/medus.jpg'),
            array('vand', 'image-26', 'files/images/vand.jpg'),
            array('melyn', 'image-27', 'files/images/melyn.jpg'),
            array('arbunz', 'image-28', 'files/images/arbunz.jpg'),
            array('banan_sult', 'image-29', 'files/images/banan_sult.jpg'),
            array('citrin_sult', 'image-30', 'files/images/citrin_sult.jpg'),
            array('anan_sult', 'image-31', 'files/images/anan_sult.jpg'),
            array('grietinele', 'image-32', 'files/images/grietinele.jpg'),
            array('cukraus_sirput', 'image-33', 'files/images/cukraus_sirput.jpg'),
            array('apelsinu_sult', 'image-34', 'files/images/apelsinu_sult.jpg'),
            array('gred_sirup', 'image-35', 'files/images/gred_sirup.jpg'),
            array('kakava', 'image-36', 'files/images/kakava.jpg'),
            array('obuol_sult', 'image-37', 'files/images/obuol_sult.jpg'),
            array('riesut_sviest', 'image-38', 'files/images/riesut_sviest.jpg'),
            array('sokolad', 'image-39', 'files/images/sokolad.jpg'),
            array('pienas', 'image-40', 'files/images/pienas.jpg'),
            array('space', 'image-41', 'files/images/space.jpg'),
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