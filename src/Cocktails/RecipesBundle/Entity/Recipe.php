<?php

namespace Cocktails\RecipesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cocktails\RecipesBundle\Entity\RecipeRepository")
 */
class Recipe
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

    /**
     * @ORM\OneToMany(targetEntity="RecipesIngredients", mappedBy="recipe", cascade={"all"})
     */
    private $ingredients;

    /**
     * @var RecipeType
     *
     * @ORM\ManyToOne(targetEntity="RecipeType", inversedBy="recipes")
     */
    private $recipeType;

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
     * Set name
     *
     * @param string $name
     * @return Recipe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Recipe
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return Recipe
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ingredients
     *
     * @param \Cocktails\RecipesBundle\Entity\RecipesIngredients $ingredients
     * @return Recipe
     */
    public function addIngredient(\Cocktails\RecipesBundle\Entity\RecipesIngredients $ingredients)
    {
        $this->ingredients[] = $ingredients;

        return $this;
    }

    /**
     * Remove ingredients
     *
     * @param \Cocktails\RecipesBundle\Entity\RecipesIngredients $ingredients
     */
    public function removeIngredient(\Cocktails\RecipesBundle\Entity\RecipesIngredients $ingredients)
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
     * Set recipeType
     *
     * @param \Cocktails\RecipesBundle\Entity\RecipeType $recipeType
     * @return Ingredient
     */
    public function setRecipeType(\Cocktails\RecipesBundle\Entity\RecipeType $recipeType = null)
    {
        $this->recipeType = $recipeType;

        return $this;
    }

    /**
     * Get recipeType
     *
     * @return \Cocktails\RecipesBundle\Entity\RecipeType
     */
    public function getRecipeType()
    {
        return $this->recipeType;
    }
}
