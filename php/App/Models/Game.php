<?php

namespace Joc4enRatlla\Models;

use Joc4enRatlla\Models\Board;
use Joc4enRatlla\Models\Player;
/**
 * Summary of Game
 * @author Dani
 * @package Joc4enRatlla\Models;
 */
class Game
{
    private Board $board;
    private int $currentPlayer;
    private array $players;
    private ?Player $winner;
    private array $scores = [1 => 0, 2 => 0];

    /**
     * Summary of __construct
     * @param \Joc4enRatlla\Models\Player $jugador1
     * @param \Joc4enRatlla\Models\Player $jugador2
     */
    public function __construct(Player $jugador1, Player $jugador2)
    {
        $this->players = [1 => $jugador1, 2 => $jugador2];
        $this->board = new Board();
        $this->currentPlayer = random_int(1, 2);
        $this->winner = null;

    }

    /**
     * Summary of reset
     * @return void
     */
    public function reset(): void
    { //Reinicia el joc
        $this->board = new Board();
        $this->winner = null;
    }

    /**
     * Summary of play
     * @param mixed $columna
     * @throws \Exception
     * @return void
     */
    public function play($columna)
    {

        if (!$this->getBoard()->isValidMove($columna)) {
            $_SESSION['error'] = "COLUMNA YA LLENA";
            return;
        }
        
        // CSi es valido el siguiente movimiento borramos el error.
        unset($_SESSION['error']);

        if (!$this->board->isValidMove($columna)) {
            throw new \Exception("Invalido movement");
        }
        //Realiza un movimiento
        $this->board->setMovementOnBoard($columna, $this->currentPlayer);

        // Revisa si el movimiento actual ha creado un 4 en raya
        if ($this->board->checkWin($this->currentPlayer)) {

            $this->setWinner($this->getPlayer());

            $this->scores[$this->currentPlayer]++;

            $this->save();

            return; //Sale de la función para evitar cambiar de jugador
        }

        //Cambia al siguiente jugador si no hay ganador
        $this->currentPlayer = $this->currentPlayer == 1 ? 2 : 1;
        $this->save();
    }
    /**
     * Summary of playAutomatic
     * @return void
     */
    public function playAutomatic()
    {
        $opponent = $this->currentPlayer === 1 ? 2 : 1;

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone ($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $this->currentPlayer);

                if ($tempBoard->checkWin($coord)) {
                    $this->play($col);
                    return;
                }
            }
        }

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone ($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $opponent);
                if ($tempBoard->checkWin($coord)) {
                    $this->play($col);
                    return;
                }
            }
        }

        $possibles = array();
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $possibles[] = $col;
            }
        }
        if (count($possibles) > 2) {
            $random = rand(-1, 1);
        }
        $middle = (int) (count($possibles) / 2) + $random;
        $inthemiddle = $possibles[$middle];
        $this->play($inthemiddle);
    }
    /**
     * Summary of save
     * @return void
     */
    public function save()
    { //Guarda l'estat del joc a les sessions
        $_SESSION['game'] = serialize($this);
    }
    /**
     * Summary of restore
     * @return mixed
     */
    public static function restore()
    { //Restaura l'estat del joc de les sessions
        //retornar la partida que está guardada en la variable de sesion.
        //Cada vez que cargue la pagina hay que hacer restore para recargar partida.
        if (isset($_SESSION['game'])) {
            return unserialize($_SESSION['game'], [Game::class]);
        }

        return null;


    }


    // getters i setters

    /**
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * @param Board $board
     */
    public function setBoard(Board $board): void
    {
        $this->board = $board;
    }

    /**
     * @return int
     */
    public function getCurrentPlayer(): int
    {
        return $this->currentPlayer;
    }

    /**
     * @param int $nextPlayer
     */
    public function setCurrentPlayer(int $nextPlayer): void
    {
        $this->currentPlayer = $nextPlayer;
    }

    /**
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    public function getPlayer(): Player
    {
        return $this->players[$this->currentPlayer];
    }

    /**
     * @param array $players
     */
    public function setPlayers(array $players): void
    {
        $this->players = $players;
    }

    /**
     * @return Player
     */
    public function getWinner(): ?Player
    {
        return $this->winner;
    }

    /**
     * @param Player $winner
     */
    public function setWinner(Player $winner): void
    {
        $this->winner = $winner;
    }

    /**
     * @return array
     */
    public function getScores(): array
    {
        return $this->scores;
    }

    /**
     * @param array $scores
     */
    public function setScores(array $scores): void
    {
        $this->scores = $scores;
    }
}

?>