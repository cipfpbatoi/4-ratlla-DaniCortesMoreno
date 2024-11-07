<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión</title>
</head>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #e5e5e5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-size: 16px;
}

.login-form {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 380px;
    text-align: center;
    transition: transform 0.3s ease-in-out;
}

.login-form:hover {
    transform: translateY(-10px);
}

.login-form h2 {
    font-size: 26px;
    color: #333;
    margin-bottom: 30px;
    font-weight: bold;
}

label {
    font-size: 14px;
    color: #666;
    text-align: left;
    margin-bottom: 5px;
    display: block;
}

input {
    width: 100%;
    padding: 14px;
    margin-bottom: 20px;
    border: 2px solid #dcdcdc;
    border-radius: 6px;
    font-size: 16px;
    outline: none;
    background-color: #f9f9f9;
    transition: all 0.3s ease;
}

input:focus {
    border-color: #4a90e2;
    background-color: #fff;
}

input[type="text"], input[type="password"] {
    color: #333;
}

button {
    width: 100%;
    padding: 15px;
    background-color: #4a90e2;
    border: none;
    border-radius: 6px;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #357ab7;
}

h3 {
    color: #d9534f;
    font-size: 14px;
    text-align: center;
    margin-bottom: 20px;
}


</style>
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
