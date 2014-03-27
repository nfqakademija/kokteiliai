<?php

namespace Cocktails\RecipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cocktails\RecipesBundle\Entity\RecipesRepository")
 */
class Recipes
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
     * @var integer
     *
     * @ORM\Column(name="recipe_type_id", type="integer")
     */
    private $recipeTypeId;


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
     * @return Recipes
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
     * @return Recipes
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
     * @return Recipes
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
     * Set recipeTypeId
     *
     * @param integer $recipeTypeId
     * @return Recipes
     */
    public function setRecipeTypeId($recipeTypeId)
    {
        $this->recipeTypeId = $recipeTypeId;

        return $this;
    }

    /**
     * Get recipeTypeId
     *
     * @return integer 
     */
    public function getRecipeTypeId()
    {
        return $this->recipeTypeId;
    }
}
