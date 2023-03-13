<?php
// Start session to store game data
session_start();

// Initialize game board with empty cells if it doesn't exist in session
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = ['', '', '', '', '', '', '', '', ''];
}

// Get player names from session
$player1 = $_SESSION['player1'];
$player2 = $_SESSION['player2'];

// Initialize score with 0 for both players if it doesn't exist in session
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = [
        'player1' => 0,
        'player2' => 0,
    ];
} else {
    // Get score from session if it already exists
    $score = $_SESSION['score'];
}
?>


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
                <!-- Display the content of the first to third cell in the game board -->
                <td id="0"><?php echo $_SESSION['board'][0] ?? '' ?></td>
                <td id="1"><?php echo $_SESSION['board'][1] ?? '' ?></td>
                <td id="2"><?php echo $_SESSION['board'][2] ?? '' ?></td>
            </tr>
            <tr>
                <!-- Display the content of the fourth to sixth cell in the game board -->
                <td id="3"><?php echo $_SESSION['board'][3] ?? '' ?></td>
                <td id="4"><?php echo $_SESSION['board'][4] ?? '' ?></td>
                <td id="5"><?php echo $_SESSION['board'][5] ?? '' ?></td>
            </tr>
            <tr>
                <!-- Display the content of the seventh to ninth cell in the game board -->
                <td id="6" class="last"><?php echo $_SESSION['board'][6] ?? '' ?></td>
                <td id="7" class="last"><?php echo $_SESSION['board'][7] ?? '' ?></td>
                <td id="8" class="last"><?php echo $_SESSION['board'][8] ?? '' ?></td>
            </tr>
        </table>

        <!-- The div displays the current player's turn. -->
        <!-- The span with id "current-player" shows the current player's name. -->
        <div class="player-name">It's <span id="current-player"><?php echo $player1 ?>'s</span> turn</div>
        <br>

        <script>
            // Set initial values
            let currentPlayer = 'X';
            let score = <?php echo json_encode($score); ?>;
            let startingPlayer = '<?php echo $score["player1"] > $score["player2"] ? "O" : "X"; ?>';

            // Function to handle playing a turn
            function playTurn(cellId) {
                const cell = document.getElementById(cellId);
                // Check if cell is empty and game is not won yet
                if (!cell.innerHTML && !checkWin()) {
                    // Send a request to update the board on the server
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'update_board.php');
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            const result = JSON.parse(xhr.responseText);
                            // Check if move is valid
                            if (result.valid) {
                                cell.innerHTML = currentPlayer;
                                // Check if the game is won
                                if (checkWin()) {
                                    alert(currentPlayer + ' wins!');
                                    score[currentPlayer === 'X' ? 'player1' : 'player2']++;
                                    updateScore();

                                    // Update session score
                                    const xhr2 = new XMLHttpRequest();
                                    xhr2.open('POST', 'update_score.php');
                                    xhr2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                    xhr2.onload = function() {
                                        if (xhr2.status === 200) {
                                            const sessionScore = JSON.parse(xhr2.responseText);
                                            score.player1 = sessionScore.player1;
                                            score.player2 = sessionScore.player2;
                                            updateScore();
                                        }
                                    };
                                    xhr2.send('player1=' + score.player1 + '&player2=' + score.player2);

                                    // Set starting player to the winner
                                    startingPlayer = currentPlayer;
                                    // Check if it's a tie
                                } else if (checkTie()) {
                                    alert('Tie!');
                                    // Set starting player to the other player
                                    startingPlayer = currentPlayer === 'X' ? 'O' : 'X';
                                    // If game is not won or tied, switch to next player
                                } else {
                                    currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
                                    // Update the display to show current player
                                    document.getElementById('current-player').innerHTML = currentPlayer === 'X' ? '<?php echo $player1 ?>' : '<?php echo $player2 ?>';
                                }
                            } else {
                                alert(result.message);
                            }
                        }
                    };
                    xhr.send('cellId=' + cellId + '&player=' + currentPlayer);
                }
            }




            function checkWin() {
                // Check rows
                for (let i = 0; i < 9; i += 3) {
                    if (checkLine(i, i + 1, i + 2)) {
                        return true;
                    }
                }

                // Check columns
                for (let i = 0; i < 3; i++) {
                    if (checkLine(i, i + 3, i + 6)) {
                        return true;
                    }
                }

                // Check diagonals
                if (checkLine(0, 4, 8) || checkLine(2, 4, 6)) {
                    return true;
                }

                return false;
            }

            // Check if there is a winning line
            function checkLine(a, b, c) {
                const cells = document.querySelectorAll('td');
                return cells[a].innerHTML && cells[a].innerHTML === cells[b].innerHTML && cells[b].innerHTML === cells[c].innerHTML;
            }

            // Check if the game is tied
            function checkTie() {
                const cells = document.querySelectorAll('td');
                for (let i = 0; i < cells.length; i++) {
                    if (!cells[i].innerHTML) {
                        return false;
                    }
                }
                return true;
            }

            // Reset the game board by clearing all cells
            function resetBoard() {
                const cells = document.querySelectorAll('td');
                for (let i = 0; i < cells.length; i++) {
                    cells[i].innerHTML = '';
                }
            }

            // Update the score for each player
            function updateScore() {
                const player1Score = document.getElementById('player1-score');
                const player2Score = document.getElementById('player2-score');
                player1Score.innerHTML = score.player1;
                player2Score.innerHTML = score.player2;
            }

            // Add event listener to each cell in the game board to play a turn when clicked
            const cells = document.querySelectorAll('td');
            for (let i = 0; i < cells.length; i++) {
                cells[i].addEventListener('click', function() {
                    playTurn(i);
                });
            }


            // Define the startNewGame function
            function startNewGame() {
                // Create a new XMLHttpRequest
                const xhr = new XMLHttpRequest();
                // Set the request method and URL
                xhr.open('POST', 'reset_board.php');
                // Set the request header
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                // Set the onload event handler for when the request is complete
                xhr.onload = function() {
                    // Check if the request was successful
                    if (xhr.status === 200) {
                        // Reset the game board
                        resetBoard();
                        // Set the current player to the starting player
                        currentPlayer = startingPlayer;
                    }
                };
                // Send the request
                xhr.send();
            }
        </script>

        <!--  Create a div to contain the game buttons-->
        <div class="button-container">
            <!--  Add a button to start a new game and set the onclick event handler to the startNewGame function-->
            <button class="game-button" onclick="startNewGame()">New Game</button>
            <!--  Add a link to reset the game and set the link target to reset.php-->
            <a class="game-button" href="reset.php">Reset Game</a>
        </div>



        <!-- Reset button for the game -->

    </div>

</body>

</html>