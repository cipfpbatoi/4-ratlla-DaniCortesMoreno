<style>
    .panel {
        background-color: #F8F9FA;
        border-radius: 10px;
        text-align: center;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

        font-family: 'Roboto', sans-serif;

    }
    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }
    p {
        font-size: 18px;
        margin: 10px 0;
    }

    .player {
        font-weight: bold;
        color: #007BFF;
    }

    .score {
        color: #28A745;
    }
</style>

<div class="panel">
    <h2>--VICTORIAS--</h2>
    <p class="player"><?php echo $players[1]->getName(); ?></p> <span class="score"><?php echo $scores[1]; ?></span>
    <br>
    <p class="player"><?php echo $players[2]->getName(); ?></p> <span class="score"><?php echo $scores[2]; ?></span>
</div>


