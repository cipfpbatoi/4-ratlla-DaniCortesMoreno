<?php
namespace Joc4enRatlla\Controllers;
use Joc4enRatlla\Services\DbService;
class LoginController
{
    public static function login($nom_usuari, $contrasenya)
    {

        $conexion = DbService::conectar();


        $sql = "select * from usuaris where nom_usuari = ?";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute([$nom_usuari]);

        $usuari = $sentencia->fetch();

        if ($usuari) {  
            if (password_verify($contrasenya, $usuari['contrasenya'])) {
                header('location: index.php');
            } else {
                $_SESSION['error'] = "Contrasenya incorrecta para el user " . $nom_usuari;
                header('location: login.php');
            }
        } else {
            $sql = "INSERT INTO usuaris(nom_usuari, contrasenya) VALUES (:nom_usuari, :contrasenya)";

            $sentencia = $conexion->prepare($sql);

            $isOk = $sentencia->execute([
                "nom_usuari" => $nom_usuari,
                "contrasenya" => password_hash($contrasenya, PASSWORD_DEFAULT)
            ]);
            header('location: index.php');
        }
    }

    public static function getIdUsuario($nom_usuari){
        $conexion = DbService::conectar();
        $sql = "SELECT id FROM usuaris WHERE nom_usuari = :nom_usuari";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute(["nom_usuari" => $nom_usuari]);
        $id = $sentencia->fetch();
        return $id['id'];
    }

    public static function eliminarPartidaBd($usuari_id) {
        $pdo = DbService::conectar();
        $sql = "DELETE FROM partides WHERE usuari_id = :usuari_id";
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(':usuari_id', $usuari_id);
        $sentencia->execute();
    }

    public static function guardarPartidaBd($partida) {
        $usuari_id = self::getIdUsuario($_SESSION['nom_usuari']);
        self::eliminarPartidaBd($usuari_id);
        $pdo = DbService::conectar();
        $sql = "INSERT INTO partides(usuari_id, game) VALUES (:usuari_id, :game)";
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(':usuari_id', $usuari_id);
        $sentencia->bindParam(':game', $partida);
        $sentencia->execute();
    }

    public static function restorePartidaBd($nom_usuari) {
        $pdo = DbService::conectar();
        $usuari_id = self::getIdUsuario($nom_usuari);
        $sql = "SELECT game FROM partides WHERE usuari_id = :usuari_id";
        $sentencia = $pdo->prepare($sql);
        $sentencia->bindParam(':usuari_id', $usuari_id);
        $sentencia->execute();
        $partida = $sentencia->fetch();
        return $partida['game'];
    }

}