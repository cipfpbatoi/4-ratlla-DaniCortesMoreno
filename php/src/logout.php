<?php
// Recuperamos la información de la sesión
session_start();
session_unset();
// Y la destruimos
session_destroy();

header("Location: login.php");
exit();