<?php

namespace Cocktails\RecipesBundle\Entity;

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
     * @var MeasureUnit
     *
     * @ORM\ManyToOne(targetEntity="MeasureUnit", inversedBy="ingredient")
     */
    private $measureUnit;


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
}
