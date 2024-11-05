<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Helpers/functions.php';
use Joc4enRatlla\Services\Logs;
use Joc4enRatlla\Controllers\LoginController;

$log = new Logs();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    LoginController::login($_POST['nom_usuari'], $_POST['contrasenya']);
    $_SESSION['nom_usuari'] = $_POST['nom_usuari'];
} else {
    loadView('login'); //Para que solo con poner localhost entre a la pagina del login.
}