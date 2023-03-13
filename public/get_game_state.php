<?php
// Start session
session_start();

// Set header to return JSON data
header('Content-Type: application/json');

// Encode session data as JSON and return it
echo json_encode([
    'board' => $_SESSION['board'],
    'currentPlayer' => $_SESSION['currentPlayer'],
    'score' => $_SESSION['score']
]);
