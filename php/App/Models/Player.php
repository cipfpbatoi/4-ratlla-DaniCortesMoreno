<?php

namespace Joc4enRatlla\Models;

/**
 * Summary of Player
 * @author Dani
 * @package Joc4enRatlla\Models;
 */
class Player
{
    private $name;      // Nom del jugador
    private $color;     // Color de les fitxes
    private $isAutomatic; // Forma de jugar (automàtica/manual)

    /**
     * Summary of __construct
     * @param mixed $name
     * @param mixed $color
     * @param mixed $isAutomatic
     */
    public function __construct($name, $color, $isAutomatic = false)
    {
        $this->name = $name;
        $this->color = $color;
        $this->isAutomatic = $isAutomatic;
    }

    // Getters i Setters 
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getIsAutomatic(): bool
    {
        return $this->isAutomatic;
    }

    /**
     * @param $isAutomatic
     */
    public function setIsAutomatic($isAutomatic)
    {
        $this->isAutomatic = $isAutomatic;
    }
}

?>