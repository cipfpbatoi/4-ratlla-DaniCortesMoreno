<html>
<head>
    <link rel="stylesheet" href="4ratlla.css?v=<?php echo time(); ?>">
    <title>4 en ratlla</title>
    <style>
        .buttonREiniciar, .buttonSalir {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .buttonSalir {
            background-color: #f44336;
        }

        .buttonREiniciar:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .buttonSalir:hover {
            background-color: #e53935;
            transform: scale(1.05);
        }

        .player1 {
            background-color: <?= $players[1]->getColor() ?> ;
        }

        .player2 {
            background-color:  <?= $players[2]->getColor() ?>;
        }
    </style>
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/error.view.php' ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/board.view.php' ?>
    <input class="buttonREiniciar" type="submit" name="reset" value="Reiniciar joc">
    <input class="buttonSalir" type="submit" name="exit" value="Acabar joc">
</form>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../Views/partials/panel.view.php' ?>
</body>
</html>
