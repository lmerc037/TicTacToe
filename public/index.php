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
        <form method="POST" action="play.php">
            <label for="player1">Player 1 Name:</label>
            <input type="text" name="player1" id="player1">

            <label for="player2">Player 2 Name:</label>
            <input type="text" name="player2" id="player2">

            <button type="submit">Start Game</button>
        </form>

    </div>


</body>

</html>