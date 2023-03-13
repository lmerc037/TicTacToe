<?php
session_start();

header('Content-Type: application/json');

echo json_encode([
    'board' => $_SESSION['board'],
    'currentPlayer' => $_SESSION['currentPlayer'],
    'score' => $_SESSION['score']
]);
