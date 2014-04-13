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
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="recipes")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var datetime
     *
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;

    /**
     * @param \Cocktails\RecipesBundle\Entity\datetime $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @return \Cocktails\RecipesBundle\Entity\datetime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }
    /**
     * @ORM\OneToMany(targetEntity="RecipesIngredients", mappedBy="recipe", cascade={"all"})
     */
    private $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity="RecipeType", inversedBy="recipe")
     */
    private $recipeType;

    /**
     * @ORM\ManyToOne(targetEntity="RecipeTaste", inversedBy="recipe")
     */
    private $recipeTaste;

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
        $ingredients->setRecipe($this);
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
     * @return Recipe
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

    /**
     * Set recipeTaste
     *
     * @param \Cocktails\RecipesBundle\Entity\RecipeTaste $recipeTaste
     * @return Recipe
     */
    public function setRecipeTaste(\Cocktails\RecipesBundle\Entity\RecipeTaste $recipeTaste = null)
    {
        $this->recipeTaste = $recipeTaste;

        return $this;
    }

    /**
     * Get recipeTaste
     *
     * @return \Cocktails\RecipesBundle\Entity\RecipeTaste 
     */
    public function getRecipeTaste()
    {
        return $this->recipeTaste;
    }

    /**
     * Set image
     *
     * @param \Cocktails\RecipesBundle\Entity\Image $image
     * @return Recipe
     */
    public function setImage(\Cocktails\RecipesBundle\Entity\Image $image = null)
    {
        $this->image = $image;
        $this->foto = $image->getPath();

        return $this;
    }

    /**
     * Get image
     *
     * @return \Cocktails\RecipesBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Recipe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get Taste by from Taste table
     *
     * @return $taste
     */
    public function getTasteByStatus($id)
    {   $taste = $this->getRecipeTaste($id)->getName();
        return $taste;
    }

    /**
     * Get Type by from Taste table
     *
     * @return $type
     */
    public function getTypeByStatus($id)
    {   $type = $this->getRecipeType($id)->getName();
        return $type;
    }
}
