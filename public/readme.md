# Tic Tac Toe Game Design System

## Overview

- This is a PHP/Javascript implementtion of a tic-tac-toe game in user vs user mode. It starts by starting a session to store game data. If the game board is not already in the session, it is initialized with empty cells. The player names are retrieved from the session, and the score is initialized with 0 for both players if it does not exist in the session. The game board is then displayed using an HTML table, and a div is added to display the current player's turn.

- The implementation includes JavaScript functions for playing a turn, checking for a win or tie, resetting the board, updating the score, and starting a new game. These functions are called in response to user interactions with the game board and buttons. The script also makes use of XMLHttpRequest objects to communicate with the server to update the board, score, and reset the game.

- The HTML code includes player names, the game board and the game buttons "New Game" and "Reset Game,".

## Components

### HTML

- `h1`: The title of the game.
- `h2`: The subtitle of the game, displaying the selected game mode.
- `table#board`: The game board where the X's and O's are placed.
- `td`: The individual cells in the game board that can be clicked to make a move.
- `div.player-name`: The container for displaying the names and scores of the players.
- `div#current-player`: The container for displaying the name of the player whose turn it is.
- `div.button-container`: The container for the game buttons.
- `button.game-button`: The button to start a new game.
- `a.game-button`: The link to reset the game.

### CSS

- ` body`: The background color and font family of the body.
- ` h1`: The text alignment, font family, and color of the game title.
- ` h2`: The font family and margin of the game subtitle.
- ` table#board`: The width, margin, and border of the game board.
- ` td`: The width, height, font-size, text-alignment, vertical-alignment, cursor, and border of the game board cells.
- ` td.last`: The removal of the bottom border of the last row in the game board.
- ` td.x and td.o`: The color of the X's and O's in the game board.
- ` div.player-name`: The margin, font-size, and text-alignment of the container for displaying the names and scores of the players.
- ` div#current-player`: The margin-top, font-size, and text-alignment of the container for displaying the name of the player whose turn it is.
- ` div.button-container`: The display, justification, alignment, and margin of the container for the game buttons.
- ` button.game-button`: The display, width, padding, background-color, color, font-size, font-weight, border, border-radius, cursor, transition, box-shadow, and margin-right of the button to start a new game.
- `a.game-button`: The display, width, padding, background-color, color, font-size, font-weight, border, border-radius, cursor, transition, box-shadow, and margin-left of the link to reset the game.

### JavaScript

- ` playTurn(cellId)`: The function to handle playing a turn.
- ` checkWin()`: The function to check if there is a winning line in the game board.
- ` checkLine(a, b, c)`: The function to check if there is a winning line in a row, column or diagonal of the game board.
- ` checkTie()`: The function to check if the game is tied.
- ` resetBoard()`: The function to reset the game board by clearing all cells.
- ` updateScore()`: The function to update the score for each player.
- ` startNewGame()`: The function to start a new game by resetting the game board and current player.

## PHP

### Variables

- `$_SESSION['board']`: Stores the current state of the game board as an array of 9 elements.
- `$player1`: Stores the name of Player 1 as a string.
- `$player2`: Stores the name of Player 2 as a string.
- `$_SESSION['score']`: Stores the current score of both players as an associative array with keys player1 and player2.

### Functions

#### `playTurn(cellId: string)`

- Handles playing a turn by taking a `cellId` parameter.
- Sends a request to update the board on the server and updates the game board if the move is valid.
- Checks if the game is won or tied, and updates the score accordingly.
- Updates the display to show whose turn it is.
- Returns nothing.

#### `checkWin()`

- Checks if there is a winning line on the game board.
- Returns true if there is a winning line, false otherwise.

#### `checkLine(a: number, b: number, c: number)`

- Checks if there is a winning line on the game board given three indices of cells.
- Returns true if there is a winning line, false otherwise.

#### `checkTie()`

- Checks if the game is tied.
- Returns true if the game is tied, false otherwise.

#### `resetBoard()`

- Resets the game board by clearing all cells.
- Returns nothing.

#### `updateScore()`

- Updates the score for each player in the score display.
- Returns nothing.

#### `startNewGame()`

- Resets the game board by sending a request to the server and updates the current player to the starting player.
  Returns nothing.

#### `Session Management`

- The `session_start()` function is used to start a session or resume a current session.
- The $\_SESSION superglobal array is used to store session data, including the game board and score.

#### `Output`

- The `echo` function is used to output player names, scores, and game board cells to the HTML document.
