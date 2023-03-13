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
            <!-- Label for Player 1 -->
            <label for="player1">Player 1 Name:</label>
            <!-- Text input for Player 1 -->
            <input type="text" name="player1" id="player1">

            <!-- Label for Player 2 -->
            <label for="player2">Player 2 Name:</label>
            <!-- Text input for Player 2 -->
            <input type="text" name="player2" id="player2">

            <!-- Button to submit form and start game -->
            <button type="submit">Start Game</button>
        </form>
    </div>


</body>

</html>