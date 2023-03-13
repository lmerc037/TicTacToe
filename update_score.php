<?php
session_start();

if (isset($_POST['player1']) && isset($_POST['player2'])) {
    $_SESSION['score']['player1'] = $_POST['player1'];
    $_SESSION['score']['player2'] = $_POST['player2'];
}

echo json_encode($_SESSION['score']);
