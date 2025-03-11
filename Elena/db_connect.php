<?php
function connectDB() { //Funktion definieren; Variablen deklarieren für DB Zugriff
    $servername = "localhost"; //Xampp lokaler zugriff = localhost
    $username = "root";  //Benutzername bei Xampp; DB Host ist root
    $password = ""; //Passwort, um Zugriff auf DB zubekommen
    $dbname = "meine_datenbank"; //Name der DB

    //new PDO erstellt neue Verbindung zur DB
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //PDO Objekt erstellen, damit Verbindung zur DB hergestellt werden kann
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Fehler werden als Ausnahme angesehen 
        return $conn; //Verbindungsobjekt als Rückgabe
    } catch(PDOException $e) { //Ausführung bei Fehler im Try Block; e ist Variable für Fehlermeldung
        die("Verbindung fehlgeschlagen: " . $e->getMessage()); 
        //Rückgabe, wenn Verbindung zur DB fehlschlägt; Code wird bei Fehler beendet
    }
}
?>