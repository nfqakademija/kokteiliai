<?php
namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\UsersIngredients;

class LoadUsersIngredientsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $usersIngredients = array(
            array('user-1','ingredient-7','15'),
            array('user-1','ingredient-3','20'),
            array('user-1','ingredient-8','50'),
            array('user-1','ingredient-25','90'),
            array('user-1','ingredient-9','200'),

            array('user-2','ingredient-11', '1'),
            array('user-2','ingredient-1', '2'),
            array('user-2','ingredient-6', '3'),
            array('user-2','ingredient-13', '2'),
            array('user-2','ingredient-14', '2'),
            array('user-2','ingredient-15', '100'),
            array('user-2','ingredient-10', '5'),
        );

        foreach($usersIngredients as $us){
            $data = new UsersIngredients();
            $data->setUser($this->getReference($us[0],$data));
            $data->setIngredient($this->getReference($us[1],$data));
            $data->setQuantity($us[2]);
            $manager->persist($data);
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
        return 4;
    }
}