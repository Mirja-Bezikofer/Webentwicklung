<?php
// config.php - Datenbankverbindung
$host = 'localhost';
$dbname = 'deine_datenbank';
$username = 'root';
$password = '';

try {
    // PDO-Verbindung zur MySQL-Datenbank
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Fehlerbehandlung mit Ausnahme
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

// Session starten, um den Login-Status zu überprüfen
session_start();

// Registrierung
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register' && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Passwort hashen
    
    // Benutzer in die Datenbank einfügen
    $stmt = $pdo->prepare("INSERT INTO users (Benutzername, Passwort) VALUES (?, ?)");
    if ($stmt->execute([$email, $password])) {
        echo json_encode(["status" => "success", "message" => "Registrierung erfolgreich!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Registrierung fehlgeschlagen."]);
    }
    exit;
}

// Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login' && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Überprüfe, ob der Benutzer existiert
    $stmt = $pdo->prepare("SELECT * FROM users WHERE Benutzername = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Passwort überprüfen
    if ($user && password_verify($password, $user['Passwort'])) {
        $_SESSION['user'] = $user['Benutzername']; // Benutzername in der Session speichern
        echo json_encode(["status" => "success", "message" => "Login erfolgreich!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Falsche Login-Daten."]);
    }
    exit;
}

// Session-Überprüfung
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'check_login') {
    if (isset($_SESSION['user'])) {
        echo json_encode(["logged_in" => true]);
    } else {
        echo json_encode(["logged_in" => false]);
    }
    exit;
}

// Logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'logout') {
    session_unset(); // Alle Session-Variablen löschen
    session_destroy(); // Session zerstören
    echo json_encode(["status" => "success", "message" => "Logout erfolgreich!"]);
    exit;
}

?>
