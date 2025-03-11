<?php
session_start(); 
require_once 'db_connect.php'; //mit PHP-Datei verbinden, damit dann DB-Verknüpfung hergestellt werden kann

//$S_SERVER ->globales Array; ["REQUEST_METHOD"] ->Anfrage mit POST-Methode ausgeführt??
if ($_SERVER["REQUEST_METHOD"] == "POST") { //Formular prüfen mit POST Methode, weil GET Methode nur bei URL
    $email = $_POST['email']; //POST-Eingabe bei email-Feld wird in $email Variable gespeichert 
    $passwort = $_POST['passwort']; //POST-Eingabe bei passwort-Feld wird in $passwort Variable gespeichert

    try {
        $conn = connectDB(); //Funktion "Verbindung zu DB aufbauen" wird in conn Variable gespeichert
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email"); //SQL Code wird in stmt gespeichert
        $stmt->bindParam(':email', $email); //eingegebene email wird in email-variable gespeichert
        $stmt->execute(); //SQL wird ausgeführt
        $user = $stmt->fetch(PDO::FETCH_ASSOC); //speichert erste Zeile in Array als Schlüssel (user) für den folgenden Code
        
        //Benutzer mit eingegebner Email gefunden?? Passt eingegebenes Passwort ggf. dazu?
        if ($user && password_verify($passwort, $user['passwort'])) { //Wenn Email und Passwort in DB registriert und übereinstimmen
            $_SESSION['user_email'] = $email; //dann wird Mail für aktuelle Session gespeichert
            $_SESSION['user_name'] = $user['name']; //dann wird Passwort für aktuelle Session gespeichert
            header("Location: ForYou.html"); //weiterleiten zu ForYouPage
            exit(); //Code ist zu ende
        } else { //Wenn Mail o. Passwort falsch 
            header("Location: error.html"); //dann zu Error Seite
            exit(); //Code ist zu ende
        }
        
    } catch(PDOException $e) { //Wenn Fehler bei DB Verknüpfung
        header("Location: error.html"); //dann zu Error Seite
        exit(); //Code ist zu ende
    }
} else { //Wenn Formular nicht mit POST abgeschickt
    header("Location: index.html"); //bei Loginseite bleiben
    exit(); //Code ist zu ende
}
?>