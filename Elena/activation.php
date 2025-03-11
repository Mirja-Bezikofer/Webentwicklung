<?php
session_start(); //PHP Session wird gestartet, um auf die Benutzerdaten zuzugreifen
if (!isset($_SESSION['user_email'])) { //Ist der Benutzer eingeloggt? "Ist Mail in aktueller Session schon gespeichert?" Wenn nein, dann...
    header("Location: index.html"); //dann weiterleiten zu LoginSeite sprich index.html
    exit(); //Code ist zu ende
}
?>

<!DOCTYPE html>
<html lang="de"> 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrierung bestätigen</title> <!--TabTitle-->
  <link rel="stylesheet" href="style_activation.css"> <!-- Verknüpfung mit CSS-Datei -->
</head>
<body> <!--sichtbarer Website-Inhalt-->
  <div class="confirmation-card"> <!-- Einfügen von Bestätigungsblock-->
    <h1 class="confirmation-header">Willst du dich sicher registrieren?</h1> <!-- Title von Container/Formularblock -->
    <form action="ForYou.html" method="GET"> <!-- Funktional: Absenden von Formular-->
      <button type="submit" class="btn">Ja, registrieren</button> <!-- Stylisch: Absenden von Formular inform von Button-->
    </form>
  </div>
</body>
</html>