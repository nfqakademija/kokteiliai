<?php

namespace Cocktails\RecipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersIngredients
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cocktails\RecipesBundle\Entity\UsersIngredientsRepository")
 */
class UsersIngredients
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Ingredient
     *
     * @ORM\ManyToOne(targetEntity="Ingredient", inversedBy="users")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     */
    private $ingredient;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ingredients")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set ingredient
     *
     * @param \Cocktails\RecipesBundle\Entity\Ingredient $ingredient
     * @return RecipesIngredients
     */
    public function setIngredient(\Cocktails\RecipesBundle\Entity\Ingredient $ingredient = null)
    {

        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return \Cocktails\RecipesBundle\Entity\Ingredient
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * Set user
     *
     * @param \Cocktails\RecipesBundle\Entity\User $user
     * @return UsersIngredients
     */
    public function setUser(\Cocktails\RecipesBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Cocktails\RecipesBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
