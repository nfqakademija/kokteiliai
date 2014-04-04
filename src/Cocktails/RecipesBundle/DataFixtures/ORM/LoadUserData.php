<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\User;

class UserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $userAdmin = new User();
        $userAdmin->setUsername('administrator');
        $userAdmin->setEmail('admin@kokteiliai.lt');
        $userAdmin->setPlainPassword('pass123');
        $userAdmin->setSuperAdmin(true);
        $userAdmin->setEnabled(true);
        $manager->persist($userAdmin);
        $manager->flush();

        $userAdmin = null;
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('adminas@kokteiliai.lt');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setSuperAdmin(true);
        $userAdmin->setEnabled(true);
        $manager->persist($userAdmin);
        $manager->flush();
    }
}