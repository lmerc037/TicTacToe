<?php
session_start();

$_SESSION['player1'] = $_POST['player1'];
$_SESSION['player2'] = $_POST['player2'];
$_SESSION['score'] = [
    'player1' => 0,
    'player2' => 0
];

// Redirect to the game board page
header('Location: game.php');
