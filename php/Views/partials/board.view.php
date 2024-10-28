<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>4 en Ratlla</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="board">
        <table>
            <tr>
                <?php if (!$winner):
                    for ($j = 1; $j <= $board::COLUMNS; $j++): ?>
                        <td><input type='submit' name='columna' value='<?= $j ?>' /></td>
                    <?php endfor; else: ?>
                    <h1>El guanyador es el jugador <?= $winner->getName() ?></h1>
                <?php endif ?>
            </tr>
            <?php for ($i = 1; $i <= $board::FILES; $i++): ?>
                <tr>
                    <?php for ($j = 1; $j <= $board::COLUMNS; $j++): ?>
                        <?php echo match ($board->getSlots()[$i][$j]) {
                            0 => '<td class="buid"></td>',
                            1 => '<td class="player1"></td>',
                            2 => '<td class="player2"></td>'
                        };
                    endfor;
            endfor ?>
            </tr>
        </table>
    </div>

</body>

</html>
