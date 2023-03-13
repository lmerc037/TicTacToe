<?php
session_start();

$valid = false;
$message = '';
$cellId = $_POST['cellId'];
$player = $_POST['player'];

// Check if the cell is empty
if (empty($_SESSION['board'][$cellId])) { // Check if the selected cell is empty
    $_SESSION['board'][$cellId] = $player; // Set the selected cell with player's symbol
    $valid = true; // Set valid to true if cell is empty and updated with player's symbol
} else {
    $message = 'Cell is already occupied'; // Set error message if the selected cell is already occupied
}

echo json_encode([
    'valid' => $valid,
    'message' => $message
]); // Send response with valid and message in JSON format