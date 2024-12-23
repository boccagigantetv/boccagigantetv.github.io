<?php
header('Content-Type: application/json');

// Controlla se il metodo è POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Metodo non consentito
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit;
}

// Processa la richiesta POST
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['username']) || !isset($input['password'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid input.']);
    exit;
}

$username = $input['username'];
$password = $input['password'];

// Percorso al file di utenti
$file = 'users.txt';

if (!file_exists($file)) {
    echo json_encode(['success' => false, 'error' => 'User file not found.']);
    exit;
}

// Legge il file di testo
$users = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$validUser = false;

foreach ($users as $user) {
    list($storedUsername, $storedPassword) = explode(':', $user);
    if ($storedUsername === $username && $storedPassword === $password) {
        $validUser = true;
        break;
    }
}

if ($validUser) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid username or password.']);
}
loginForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    const response = await fetch('check_login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password })
    });

    const result = await response.json();

    if (result.success) {
        alert('Login successful!');
        window.location.href = 'home.html';
    } else {
        errorMessage.textContent = result.error || 'Invalid username or password.';
    }
});
?>
