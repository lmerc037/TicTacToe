const board = document.querySelector("#board");
const cells = board.getElementsByTagName("td");
const resetButton = document.querySelector("#reset-button");
const result = document.querySelector("#result");
const turn = document.querySelector("#turn");
let currentPlayer = "x";
let user1Wins = 0;
let user2Wins = 0;

resetButton.addEventListener("click", function () {
  restart();
});

for (let i = 0; i < cells.length; i++) {
  cells[i].addEventListener("click", function (event) {
    if (event.target.textContent === "" && currentPlayer === "x") {
      event.target.textContent = "x";
      if (checkForWin("x")) {
        alert("Player X wins!");
        restart();
      } else if (checkForDraw()) {
        alert("Draw!");
        restart();
      } else {
        currentPlayer = "o";
        if (mode === "user-vs-user") {
          computerTurn();
        }
      }
    } else if (event.target.textContent === "" && currentPlayer === "o") {
      event.target.textContent = "o";
      if (checkForWin("o")) {
        alert("Player O wins!");
        restart();
      } else if (checkForDraw()) {
        alert("Draw!");
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
