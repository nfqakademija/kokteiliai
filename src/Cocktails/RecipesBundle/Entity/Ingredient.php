<?php

namespace Cocktails\RecipesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cocktails\RecipesBundle\Entity\IngredientRepository")
 */
class Ingredient
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
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="ingredients")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

    /**
     * @var MeasureUnit
     *
     * @ORM\ManyToOne(targetEntity="MeasureUnit", inversedBy="ingredients")
     */
    private $measureUnit;

    /**
     * @ORM\OneToMany(targetEntity="RecipesIngredients", mappedBy="recipe", cascade={"all"})
     */
    private $recipes;

    /**
     * @ORM\OneToMany(targetEntity="UsersIngredients", mappedBy="ingredient", cascade={"all"})
     */
    private $users;

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
     * @return Ingredient
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
     * @return Ingredient
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
     * Set measureUnit
     *
     * @param \Cocktails\RecipesBundle\Entity\MeasureUnit $measureUnit
     * @return Ingredient
     */
    public function setMeasureUnit(\Cocktails\RecipesBundle\Entity\MeasureUnit $measureUnit = null)
    {
        $this->measureUnit = $measureUnit;

        return $this;
    }

    /**
     * Get measureUnit
     *
     * @return \Cocktails\RecipesBundle\Entity\MeasureUnit 
     */
    public function getMeasureUnit()
    {
        return $this->measureUnit;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add recipes
     *
     * @param \Cocktails\RecipesBundle\Entity\RecipesIngredients $recipes
     * @return Ingredient
     */
    public function addRecipe(\Cocktails\RecipesBundle\Entity\RecipesIngredients $recipes)
    {
        $this->recipes[] = $recipes;

        return $this;
    }

    /**
     * Remove recipes
     *
     * @param \Cocktails\RecipesBundle\Entity\RecipesIngredients $recipes
     */
    public function removeRecipe(\Cocktails\RecipesBundle\Entity\RecipesIngredients $recipes)
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

    /**
     * Set image
     *
     * @param \Cocktails\RecipesBundle\Entity\Image $image
     * @return Ingredient
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
     * @param \Cocktails\RecipesBundle\Entity\User $users
     * @return Ingredient
     */
    public function addUser(\Cocktails\RecipesBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Cocktails\RecipesBundle\Entity\User $users
     */
    public function removeUser(\Cocktails\RecipesBundle\Entity\User $users)
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
