<?php

namespace Cocktails\RecipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Recipe
 *
 * @ORM\Entity(repositoryClass="Cocktails\RecipesBundle\Entity\RecipeRepository")
 * @ORM\Table(name="recipe", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="ingredients_idx", columns={"name"})})
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
     * @ORM\OneToMany(targetEntity="RecipesIngredients", mappedBy="recipe", orphanRemoval=true, cascade={"all"})
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="UsersRecipes", mappedBy="recipe", orphanRemoval=true)
     */
    private $users;

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
     * Increase rank
     * @return Recipe
     */
    public function incRank()
    {
        $this->rank += 1;
        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
//        print_r($ingredients->getIngredient()->getId());
//        echo '<br />';
//        print_r($ingredients->getRecipe()->getId());
//        echo '<br />';
//        die('remove');

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

    /**
     * @param $id
     * @return string
     */
    public function getImageByStatus($id)
    {
        $image = $this->getImage($id)->getPath();
        return $image;
    }

    /**
     * Add users
     *
     * @param \Cocktails\RecipesBundle\Entity\UsersRecipes $users
     * @return Recipe
     */
    public function addUser(\Cocktails\RecipesBundle\Entity\UsersRecipes $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Cocktails\RecipesBundle\Entity\UsersRecipes $users
     */
    public function removeUser(\Cocktails\RecipesBundle\Entity\UsersRecipes $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
