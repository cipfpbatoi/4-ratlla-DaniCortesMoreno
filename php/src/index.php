<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Helpers/functions.php';
use Joc4enRatlla\Controllers\GameController;
use Joc4enRatlla\Services\Logs;

$log = new Logs();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameController = new GameController($log ,$_POST); 
} else {
    loadView('jugador');
}