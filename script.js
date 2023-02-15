const board = document.querySelector("#board");
const cells = board.getElementsByTagName("td");
const resetButton = document.querySelector("#reset-button");
const result = document.querySelector("#result");
const turn = document.querySelector("#turn");
let mode = "user-vs-computer";
let currentPlayer = "x";
let computerWins = 0;
let userWins = 0;
let user1Wins = 0;
let user2Wins = 0;

document.querySelectorAll("input[name='mode']").forEach(function (input) {
  input.addEventListener("change", function () {
    mode = input.value;
    restart();

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

resetButton.addEventListener("click", function () {
  restart();
});

for (let i = 0; i < cells.length; i++) {
  cells[i].addEventListener("click", function (event) {
    if (event.target.textContent === "" && currentPlayer === "x") {
      event.target.textContent = "x";
      if (mode === "user-vs-computer") {
        turn.textContent = "Turn: Computer";
      } else {
        turn.textContent = "Turn: User 2";
      }
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
        result.textContent = "Draw!";
        restart();
      } else {
        currentPlayer = "o";
        if (mode === "user-vs-computer") {
          computerTurn();
        }
      }
    } else if (event.target.textContent === "" && currentPlayer === "o") {
      event.target.textContent = "o";
      if (mode === "user-vs-computer") {
        turn.textContent = "Turn: User";
      } else {
        turn.textContent = "Turn: User 1";
      }
      if (checkForWin("o")) {
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
        result.textContent = "Draw!";
        restart();
      } else {
        currentPlayer = "x";
      }
    }
  });
}

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

function checkForDraw() {
  for (let i = 0; i < cells.length; i++) {
    if (cells[i].textContent === "") {
      return false;
    }
  }
  return true;
}

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
