<?php
session_start();
require_once 'db_connect.php';

// Wenn das Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") { //Anfrage eine POST-Anfrage?
    $name = $_POST['name']; //Holt von jeweiligem Formularfeld die Eingabe und speichert diesen in passender Variable
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];
    $passwort = password_hash($_POST['passwort'], PASSWORD_DEFAULT); //Hasht Passwort aus Formularfeld für sichere Speicherung

    $conn = connectDB();

    try {
        $stmt = $conn->prepare("INSERT INTO users (name, nachname, email, passwort) VALUES (:name, :nachname, :email, :passwort)"); //SQL Abfrage
        $stmt->bindParam(':name', $name); //Ersetzt Variable durch Platzhalter in der SQL-Abfrage
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':passwort', $passwort);
        $stmt->execute();

        $_SESSION['user_email'] = $email; //Mail wird für aktuelle Session gespeichert
        $_SESSION['user_name'] = $name; //Name wird für aktuelle Session gespeichert
        header("Location: activation.php"); //Verlinkung zu Aktivierungsseite ->ersetzt Email Bestätigung
    } catch(PDOException $e) { //Wenn Fehler bei SQL Ausführung
            $_SESSION['message'] = "Registrierung fehlgeschlagen: " . $e->getMessage();
        header("Location: register.html"); //
    }
    exit();
}
?>