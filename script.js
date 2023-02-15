// Select elements for the game
const board = document.querySelector("#board");
const cells = board.getElementsByTagName("td");
const resetButton = document.querySelector("#reset-button");
const result = document.querySelector("#result");
const turn = document.querySelector("#turn");

// Define variables
let mode = "user-vs-computer"; // default game mode
let currentPlayer = "x"; // current player
let computerWins = 0; // number of computer wins
let userWins = 0; // number of user wins
let user1Wins = 0; // number of user 1 wins
let user2Wins = 0; // number of user 2 wins

// Add event listener to radio buttons for game mode selection
document.querySelectorAll("input[name='mode']").forEach(function (input) {
  input.addEventListener("change", function () {
    mode = input.value;
    restart();

    // Show or hide elements based on game mode
    if (mode === "user-vs-computer") {
      document.querySelector("#user-wins").style.display = "block";
      document.querySelector("#computer-wins").style.display = "block";
      document.querySelector("#user1-wins").style.display = "none";
      document.querySelector("#user2-wins").style.display = "none";
    } else {
      document.querySelector("#user-wins").style.display = "none";
      document.querySelector("#computer-wins").style.display = "none";
      document.querySelector("#user1-wins").style.display = "block";
      document.querySelector("#user2-wins").style.display = "block";
      result.textContent = "";
    }
  });
});

// Add event listener to reset button
resetButton.addEventListener("click", function () {
  restart();
});

for (let i = 0; i < cells.length; i++) {
  cells[i].addEventListener("click", function (event) {
    if (event.target.textContent === "" && currentPlayer === "x") {
      // If it is player X's turn and the cell is empty, place X in the cell
      event.target.textContent = "x";
      if (mode === "user-vs-computer") {
        turn.textContent = "Turn: Computer";
      } else {
        turn.textContent = "Turn: User 2";
      }
      // Check for a win or a draw
      if (checkForWin("x")) {
        if (mode === "user-vs-computer") {
          result.textContent = "Player X wins!";
          console.log(result.textContent);

          userWins++;
        } else {
          result.textContent = "User 1 wins!";
          user1Wins++;
        }
        restart();
      } else if (checkForDraw()) {
        // If it's a draw, update the result and restart the game
        result.textContent = "Draw!";
        restart();
      } else {
        // If the game continues, switch to player O's turn
        currentPlayer = "o";
        if (mode === "user-vs-computer") {
          computerTurn();
        }
      }
    } else if (event.target.textContent === "" && currentPlayer === "o") {
      // If it is player O's turn and the cell is empty, place O in the cell
      event.target.textContent = "o";
      if (mode === "user-vs-computer") {
        turn.textContent = "Turn: User";
      } else {
        turn.textContent = "Turn: User 1";
      }
      // Check for a win or a draw
      if (checkForWin("o")) {
        // If O wins, update the result and restart the game
        if (mode === "user-vs-computer") {
          result.textContent = "Computer wins!";
          console.log(result.textContent);
          computerWins++;
        } else {
          result.textContent = "User 2 wins!";
          user2Wins++;
        }
        restart();
      } else if (checkForDraw()) {
        // If it's a draw, update the result and restart the game
        result.textContent = "Draw!";
        restart();
      } else {
        // If the game continues, switch to player X's turn
        currentPlayer = "x";
      }
    }
  });
}
// Function to check if a player has won
function checkForWin(player) {
  const combinations = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ];
  // Check if any of the combinations match the player's moves
  for (const combination of combinations) {
    if (
      cells[combination[0]].textContent === player &&
      cells[combination[1]].textContent === player &&
      cells[combination[2]].textContent === player
    ) {
      return true;
    }
  }
  return false;
}
// Function to check if the game is a draw
function checkForDraw() {
  for (let i = 0; i < cells.length; i++) {
    if (cells[i].textContent === "") {
      return false;
    }
  }
  return true;
}
// Function for computer's random move
function computerTurn() {
  let move = Math.floor(Math.random() * 9);
  while (cells[move].textContent !== "") {
    move = Math.floor(Math.random() * 9);
  }
  cells[move].textContent = "o";
  turn.textContent = "Turn: User";
  if (checkForWin("o")) {
    result.textContent = "Computer wins!";
    computerWins++;
    restart();
  } else if (checkForDraw()) {
    result.textContent = "Draw!";
    restart();
  } else {
    currentPlayer = "x";
  }
}

// Function to restart the game
function restart() {
  for (let i = 0; i < cells.length; i++) {
    cells[i].textContent = "";
  }

  if (mode === "user-vs-computer") {
    if (currentPlayer === "x") {
      turn.textContent = "Turn: User";
    } else {
      turn.textContent = "Turn: Computer";
    }
    document.querySelector("#user-wins").textContent = `User wins: ${userWins}`;
    document.querySelector(
      "#computer-wins"
    ).textContent = `Computer wins: ${computerWins}`;
  } else {
    if (currentPlayer === "x") {
      turn.textContent = "Turn: User 1";
    } else {
      turn.textContent = "Turn: User 2";
    }
    document.querySelector(
      "#user1-wins"
    ).textContent = `User 1 wins: ${user1Wins}`;
    document.querySelector(
      "#user2-wins"
    ).textContent = `User 2 wins: ${user2Wins}`;
  }
}
