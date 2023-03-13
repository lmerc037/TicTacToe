<?php
session_start();

$valid = false;
$message = '';
$cellId = $_POST['cellId'];
$player = $_POST['player'];

// Check if the cell is empty
if (empty($_SESSION['board'][$cellId])) {
    $_SESSION['board'][$cellId] = $player;
    $valid = true;
} else {
    $message = 'Cell is already occupied';
}

echo json_encode([
    'valid' => $valid,
    'message' => $message
]);
