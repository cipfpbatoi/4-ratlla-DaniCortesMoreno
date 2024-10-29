<?php
namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;
use Joc4enRatlla\Services\Logs;


class GameController
{
    private Game $game;
    private Logs $log;
    // Request és l'array $_POST

    public function __construct(Logs $log, $request = null)
    {
        $this->log = $log;
        // TODO: Inicialització del joc.Ha d'inicializar el Game si és la primera vegada o agafar les dades de la sessió si ja ha estat inicialitzada
        if (isset($request['nombre']) && isset($request['color'])) {
            $jugador1 = new Player($request['nombre'], $request['color']);
            $jugador2 = new Player("Computadora", "pink", true);
            $this->game = new Game($jugador1, $jugador2); //guardar partida en variable de sesión cridant a la funcion game.save
            $this->game->save();
        } else {
            $this->game = Game::restore();
        }

        //Inicialització del joc
        $this->play($request);

    }

    public function play(array $request)
    {

        // Gestió del joc
        // TODO : Gestió del joc. Ací es on s'ha de vore si hi ha guanyador, si el que juga es automàtic  o manual, s'ha polsat reiniciar...
        //dd($this);

        try {
            if (!$this->game->getBoard()->isFull()) {
                if ($this->game->getPlayer()->getIsAutomatic()) {
                    $this->game->playAutomatic();
                } else {
                    if ($request == $_POST && isset($request['columna'])) {
                        $this->game->play($request['columna']);
                        $this->log->getLog()->info("El jugador " . $this->game->getPlayer()->getName() . " introduce una ficha en la columna " . $request['columna']);
                    }
                }
            } else {
                $this->log->getLog()->info("Tablero lleno");
                echo "Tablero lleno";
                $this->game->setWinner(null);
            }
        } catch (\Exception $err) {
            $this->log->getLog()->error("Error en la columna " . $request['columna']);

        }
        

        //Guarda l'estat del joc a les sessions
        if (isset($request['reset'])) {
            $this->game->reset();
            $this->game->save();
        }

        if (isset($request['exit'])) {
            unset($_SESSION['game']);
            session_destroy();
            header('location: index.php');
            exit;
        }


        $board = $this->game->getBoard();
        $players = $this->game->getPlayers();
        $winner = $this->game->getWinner();
        $scores = $this->game->getScores();

        loadView('index', compact('board', 'players', 'winner', 'scores'));
    }

}
?>