<?php
// Ottieni i dati inviati tramite POST
$data = json_decode(file_get_contents("php://input"), true);

// Verifica se i dati sono validi
if ($data) {
    // Salva i dati nel file JSON
    file_put_contents('users.json', json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
