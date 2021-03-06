<?php

namespace Cocktails\RecipesBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="UsersIngredients", mappedBy="user", cascade={"all"})
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="UsersRecipes", mappedBy="user", cascade={"all"})
     */
    private $recipes;

    public function __construct()
    {
        parent::__construct();
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {   //$this->getLastLogin();
        return $this->id;
    }

    /**
     * Add ingredients
     *
     * @param \Cocktails\RecipesBundle\Entity\Ingredient $ingredients
     * @return User
     */
    public function addIngredient(\Cocktails\RecipesBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients[] = $ingredients;

        return $this;
    }

    /**
     * Remove ingredients
     *
     * @param \Cocktails\RecipesBundle\Entity\Ingredient $ingredients
     */
    public function removeIngredient(\Cocktails\RecipesBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients->removeElement($ingredients);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }



    /**
     * Add recipes
     *
     * @param \Cocktails\RecipesBundle\Entity\UsersRecipes $recipes
     * @return User
     */
    public function addRecipe(\Cocktails\RecipesBundle\Entity\UsersRecipes $recipes)
    {
        $this->recipes[] = $recipes;

        return $this;
    }

    /**
     * Remove recipes
     *
     * @param \Cocktails\RecipesBundle\Entity\UsersRecipes $recipes
     */
    public function removeRecipe(\Cocktails\RecipesBundle\Entity\UsersRecipes $recipes)
    {
        $this->recipes->removeElement($recipes);
    }

    /**
     * Get recipes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}
