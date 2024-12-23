onst express = require('express');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = 3000;
const USERS_FILE = path.join(__dirname, 'users.txt');

app.use(express.json());
app.use(express.static(__dirname));

// Endpoint per il login
app.post('/login', (req, res) => {
    const { username, password } = req.body;

    // Leggi il file di credenziali
    fs.readFile(USERS_FILE, 'utf-8', (err, data) => {
        if (err) {
            return res.status(500).json({ message: 'Errore del server' });
        }

        // Controlla se le credenziali sono valide
        const users = data.split('\n').map(line => line.trim());
        const isValid = users.some(user => user === `${username}:${password}`);

        if (isValid) {
            res.json({ message: 'Login riuscito!' });
        } else {
            res.json({ message: 'Credenziali non valide' });
        }
    });
});

// Avvio del server
app.listen(PORT, () => {
    console.log(`Server in esecuzione su http://localhost:${PORT}`);
});