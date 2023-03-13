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

        <script>
            function playTurn(cellId) {
                const cell = document.getElementById(cellId);
                if (!cell.innerHTML) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'update_board.php');
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            const result = JSON.parse(xhr.responseText);
                            if (result.valid) {
                                cell.innerHTML = currentPlayer;
                                if (checkWin()) {
                                    alert(currentPlayer + ' wins!');
                                    score[currentPlayer === 'X' ? 'player1' : 'player2']++;
                                    resetBoard();
                                    updateScore();
                                } else if (checkTie()) {
                                    alert('Tie!');
                                    resetBoard();
                                } else {
                                    currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
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

            function checkLine(a, b, c) {
                const cells = document.querySelectorAll('td');
                return cells[a].innerHTML && cells[a].innerHTML === cells[b].innerHTML && cells[b].innerHTML === cells[c].innerHTML;
            }

            function checkTie() {
                const cells = document.querySelectorAll('td');
                for (let i = 0; i < cells.length; i++) {
                    if (!cells[i].innerHTML) {
                        return false;
                    }
                }
                return true;
            }


            function resetBoard() {
                const cells = document.querySelectorAll('td');
                for (let i = 0; i < cells.length; i++) {
                    cells[i].innerHTML = '';
                }
            }

            function updateScore() {
                const player1Score = document.getElementById('player1-score');
                const player2Score = document.getElementById('player2-score');
                player1Score.innerHTML = score.player1;
                player2Score.innerHTML = score.player2;
            }
        </script>
    </div>

</body>

</html>