<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión</title>
</head>
<body>
    <h3><?php 
    if (!empty($_SESSION['error'])) {
        echo $_SESSION['error']; 
    }
    ?></h3>
    <div class="login-form">
        <h2>Iniciar Sesión</h2>
        <form action="" method="POST">
            <label for="nom_usuari">Usuario: </label>
            <input type="text" id="nom_usuari" name="nom_usuari" required>

            <label for="contrasenya">Contraseña: </label>
            <input type="password" id="contrasenya" name="contrasenya" required>

            <button type="submit">ENTRAR</button>
        </form>
    </div>
</body>
</html>