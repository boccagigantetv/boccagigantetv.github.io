<?php
header('Content-Type: application/json');

// Legge i dati inviati dal client
$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'];
$password = $input['password'];

// Percorso al file di utenti
$file = 'users.txt';

// Controlla se il file esiste
if (!file_exists($file)) {
    echo json_encode(['success' => false]);
    exit;
}

// Legge il file di testo
$users = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$validUser = false;

// Controlla se username e password sono validi
foreach ($users as $user) {
    list($storedUsername, $storedPassword) = explode(':', $user);
    if ($storedUsername === $username && $storedPassword === $password) {
        $validUser = true;
        break;
    }
}

// Risponde con successo o errore
echo json_encode(['success' => $validUser]);
?>
