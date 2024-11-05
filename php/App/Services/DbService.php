<?php

namespace Joc4enRatlla\Services;
use \PDO;
use \PDOException;
class DbService
{
    public static function conectar()
    {
        $conn = require $_SERVER['DOCUMENT_ROOT'] . '/../config/connection.php';

        try {
            $dsn = 'mysql:host=' . $conn['host'] . ';dbname=' . $conn['dbname'];
            $usuari = $conn['username'];
            $contrasenya = $conn['password'];
            $pdo = new PDO($dsn, $usuari, $contrasenya);
        } catch (PDOException $e) {
            echo "Error de conexió: " . $e->getMessage();
            exit();
        }

        return $pdo;
    }

}

