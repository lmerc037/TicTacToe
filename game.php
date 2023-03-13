<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe Game</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Title of the game -->
    <h1>Tic Tac Toe Game</h1>
    <h2>User vs User Mode</h2>
    <div id="tic-tac-toe">
        <div class="player-name">Player 1 (X) : <span><?php echo $player1 ?> <span id="player1-score"><?php echo $_SESSION['score']['player1'] ?></span></span> <br /> <br /> Player 2 (O): <span><?php echo $player2 ?> <span id="player2-score"><?php echo $_SESSION['score']['player2'] ?></span></span> </div>

        <!-- Game board -->
        <table id="board">
            <tr>
                <td id="0"><?php echo $_SESSION['board'][0] ?? '' ?></td>
                <td id="1"><?php echo $_SESSION['board'][1] ?? '' ?></td>
                <td id="2"><?php echo $_SESSION['board'][2] ?? '' ?></td>
            </tr>
            <tr>
                <td id="3"><?php echo $_SESSION['board'][3] ?? '' ?></td>
                <td id="4"><?php echo $_SESSION['board'][4] ?? '' ?></td>
                <td id="5"><?php echo $_SESSION['board'][5] ?? '' ?></td>
            </tr>
            <tr>
                <td id="6" class="last"><?php echo $_SESSION['board'][6] ?? '' ?></td>
                <td id="7" class="last"><?php echo $_SESSION['board'][7] ?? '' ?></td>
                <td id="8" class="last"><?php echo $_SESSION['board'][8] ?? '' ?></td>
            </tr>
        </table>

        <div class="player-name">It's <span id="current-player"><?php echo $player1 ?>'s</span> turn</div>
        <br>



    </div>

</body>

</html>