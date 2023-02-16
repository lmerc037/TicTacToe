# Tic Tac Toe Game

## Design System

### Components

- `h1`: The title of the game.
- `input[type="radio"]`: The radio buttons for selecting the game mode.
- `table#board`: The game board where the X's and O's are placed.
- `button#reset-button`: The button to reset the game.
- `div#turn`: The container for displaying whose turn it is.
- `div#user-wins`, `div#computer-wins`, `div#user1-wins`, `div#user2-wins`: The containers for displaying the scores.
- `div#result`: The container for displaying the game result.

### Styles

- `body`: The background color and font family of the body.
- `h1`: The text alignment, font family, and color of the game title.
- `#tic-tac-toe`: The width, margin, padding, border-radius, box-shadow, font-family, and background of the main container for the game.
- `#board td`: The width, height, font-size, text-alignment, vertical-alignment, cursor, and border of the game board cells.
- `#board td:nth-child(1)`, `#board td:nth-child(2)`, and `#board td:nth-child(3)`: The borders for the game board cells.
- `#board td:hover`: The background color of the game board cells when hovered.
- `#board td.last`: The removal of the bottom border of the last row in the game board.
- `#board td.x` and `#board td.o`: The color of the X's and O's in the game board.
- `#result`: The margin-top, font-size, and text-alignment of the game result.
- `#turn`: The margin-top, font-size, and text-alignment of the container for displaying whose turn it is.
- `.resultcontainer`: The display, justification, alignment, margin, and gap of the containers for displaying the scores.
- `#reset-button`: The display, width, padding, background-color, color, font-size, font-weight, border, border-radius, cursor, transition, box-shadow, and margin-bottom of the reset button.
- `#reset-button:hover`: The background-color of the reset button when hovered.
- `#user1-wins` and `#user2-wins`: The hiding of the containers for displaying the scores in user vs user mode.
- `.mode-switch`: The display, justification, alignment, and margin of the container for the game mode selection.
- `.mode-switch label`: The display, position, padding, background-color, color, font-size, font-weight, border-radius, cursor, transition, box-shadow, and margin of the labels for the game mode selection.
- `.mode-switch input[type="radio"]`: The hiding of the radio buttons for the game mode selection.
- `.mode-switch input[type="radio"]:checked + label`: The color and background of the selected game mode label.
- `.mode-switch input[type="radio"]:checked + label:before`: The scaling of the selected game mode label.
