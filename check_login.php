<?php
header('Content-Type: application/json');

// Controlla se i dati sono stati inviati correttamente
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['username']) || !isset($input['password'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid input.']);
    exit;
}

$username = $input['username'];
$password = $input['password'];

// Percorso al file di utenti
$file = 'users.txt';

// Controlla se il file esiste
if (!file_exists($file)) {
    echo json_encode(['success' => false, 'error' => 'User file not found.']);
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
if ($validUser) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid username or password.']);
}
?>
