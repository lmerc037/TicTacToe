<?php
session_start();

// Check if player1 and player2 are submitted through POST
if (isset($_POST['player1']) && isset($_POST['player2'])) {
    // Update session score with submitted player1 and player2 names
    $_SESSION['score']['player1'] = $_POST['player1'];
    $_SESSION['score']['player2'] = $_POST['player2'];
}

// Return updated session score in JSON format
echo json_encode($_SESSION['score']);
