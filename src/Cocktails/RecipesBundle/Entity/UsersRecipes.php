<?php
/**
 * Created by PhpStorm.
 * User: Audrius
 * Date: 14.5.2
 * Time: 18.26
 */

namespace Cocktails\RecipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersIngredients
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cocktails\RecipesBundle\Entity\UsersRecipesRepository")
 */
class UsersRecipes
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="recipes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="users")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    private $recipe;

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
     * Set user
     *
     * @param \Cocktails\RecipesBundle\Entity\User $user
     * @return UsersRecipes
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

    /**
     * Set recipe
     *
     * @param \Cocktails\RecipesBundle\Entity\Recipe $recipe
     * @return UsersRecipes
     */
    public function setRecipe(\Cocktails\RecipesBundle\Entity\Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \Cocktails\RecipesBundle\Entity\Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
