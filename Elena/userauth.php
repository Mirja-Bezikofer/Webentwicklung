<?php
// config.php - Datenbankverbindung
$host = 'localhost';
$dbname = 'deine_datenbank';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

session_start();

// register.php - Benutzer registrieren
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    require 'config.php';
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (Benutzername, Passwort) VALUES (?, ?)");
    if ($stmt->execute([$email, $password])) {
        echo json_encode(["status" => "success", "message" => "Registrierung erfolgreich!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Registrierung fehlgeschlagen."]);
    }
}

// login.php - Benutzer einloggen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    require 'config.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE Benutzername = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['Passwort'])) {
        $_SESSION['user'] = $user['Benutzername'];
        echo json_encode(["status" => "success", "message" => "Login erfolgreich!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Falsche Login-Daten."]);
    }
}

// session_check.php - Überprüfung des Login-Status
if (isset($_SESSION['user'])) {
    echo json_encode(["logged_in" => true]);
} else {
    echo json_encode(["logged_in" => false]);
}

// logout.php - Benutzer ausloggen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    echo json_encode(["status" => "success", "message" => "Logout erfolgreich!"]);
}
