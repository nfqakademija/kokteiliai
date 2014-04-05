<?php

namespace Cocktails\RecipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipesIngredients
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cocktails\RecipesBundle\Entity\RecipesIngredientsRepository")
 */
class RecipesIngredients
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
     * @ORM\ManyToOne(targetEntity="Ingredient", inversedBy="recipes")
     */
    private $ingredient;

    /**
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="ingredients")
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
     * Set recipe
     *
     * @param \Cocktails\RecipesBundle\Entity\Recipe $recipe
     * @return RecipesIngredients
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