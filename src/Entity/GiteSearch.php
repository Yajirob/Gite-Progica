<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class GiteSearch {

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *          min=20,
     *          max=500,
     *          notInRangeMessage= "La surface doit être comprise entre {{ min }} et {{ max}} m²"
     * )
     */
    private $minSurface;
    private $maxBedrooms;

    /**
     * Get the value of minSurface
     */ 
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @return  self
     */ 
    public function setMinSurface( int $minSurface)
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get the value of maxBedrooms
     */ 
    public function getMaxBedrooms()
    {
        return $this->maxBedrooms;
    }

    /**
     * Set the value of maxBedrooms
     *
     * @return  self
     */ 
    public function setMaxBedrooms( int $maxBedrooms)
    {
        $this->maxBedrooms = $maxBedrooms;

        return $this;
    }
}