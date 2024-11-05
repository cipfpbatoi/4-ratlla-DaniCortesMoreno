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

}