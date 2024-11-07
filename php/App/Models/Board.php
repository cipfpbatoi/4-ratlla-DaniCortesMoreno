<?php

namespace Joc4enRatlla\Models;

class Board
{
    public const FILES = 6;
    public const COLUMNS = 7;
    public const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];

    private array $slots;

    public function __construct()
    {
        $this->slots = self::initializeBoard();
    }

    // Getters i Setters 
    /**
     * @return array
     */
    public function getSlots(): array
    {
        return $this->slots;
    }
    /**
     * @param array $slots
     */
    public function setSlots(array $slots): void
    {
        $this->slots = $slots;
    }

    private static function initializeBoard(): array
    { //Inicialitza la graella amb valors buits

        $graellaBuida = array_fill(1, 6, array_fill(1, 7, 0));
        return $graellaBuida;
    }
    public function setMovementOnBoard(int $column, int $player): array
    { //Realitza un moviment en la graella
        for ($i = count($this->slots); $i > 0; $i--) {
            if ($this->slots[$i][$column] == 0) {
                $this->slots[$i][$column] = $player;
                break;
            }
        }
        return $this->slots;
    }
    public function checkWin($jugador): bool
    { //Comprova si hi ha un guanyador (Se puede tener diferente)
        $files = count($this->slots);
        $columnes = count($this->slots[1]);

        // Comprovar horitzontals
        for ($i = 1; $i <= $files; $i++) {
            for ($j = 1; $j <= $columnes - 3; $j++) {
                if (
                    $this->slots[$i][$j] == $jugador && $this->slots[$i][$j + 1] == $jugador &&
                    $this->slots[$i][$j + 2] == $jugador && $this->slots[$i][$j + 3] == $jugador
                ) {
                    return true;
                }
            }
        }

        // Comprovar verticals
        for ($i = 1; $i <= $files - 3; $i++) {
            for ($j = 1; $j <= $columnes; $j++) {
                if (
                    $this->slots[$i][$j] == $jugador && $this->slots[$i + 1][$j] == $jugador &&
                    $this->slots[$i + 2][$j] == $jugador && $this->slots[$i + 3][$j] == $jugador
                ) {
                    return true;
                }
            }
        }

        // Comprovar diagonals ascendents
        for ($i = 3; $i < $files; $i++) {
            for ($j = 1; $j < $columnes - 3; $j++) {
                if (
                    $this->slots[$i][$j] == $jugador && $this->slots[$i - 1][$j + 1] == $jugador &&
                    $this->slots[$i - 2][$j + 2] == $jugador && $this->slots[$i - 3][$j + 3] == $jugador
                ) {
                    return true;
                }
            }
        }

        // Comprovar diagonals descendents
        for ($i = 1; $i < $files - 3; $i++) {
            for ($j = 1; $j < $columnes - 3; $j++) {
                if (
                    $this->slots[$i][$j] == $jugador && $this->slots[$i + 1][$j + 1] == $jugador &&
                    $this->slots[$i + 2][$j + 2] == $jugador && $this->slots[$i + 3][$j + 3] == $jugador
                ) {
                    return true;
                }
            }
        }

        return false;
    }
    public function isValidMove(int $column): bool
    { //Comprova si el moviment és vàlid (Ccomprueba si el jugador está intentando jugar en una columna llena)
        if ($this->slots[1][$column] === 0) {
            return true;
        }
        return false;
    }

    public function isFull(): bool
    {
        for ($i = 1; $i <= 6; $i++) {
            for ($j = 1; $j <= 7; $j++) {
                if ($this->slots[$i][$j] == 0) {
                    return false;
                }
            }
        }
        return true;
    }

}

?>