<?php
session_start(); //PHP Session wird dadurch gestartet; steht immer am Anfang einer PHP-Datei

if (!isset($_SESSION['user_email'])) { //Ist Benutzer eingeloggt?
    header("Location: index.html");
    exit();
}

require_once 'db_connect.php'; //mit PHP-Datei verbinden, damit dann DB-Verknüpfung hergestellt werden kann

$conn = connectDB(); //Verbindung zur Datenbank herstellen; $conn ist Variable für connectDB() Funktion

// Formularverarbeitung: Profil aktualisieren
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) { //Anfrage eine POST-Anfrage? Formularfeld 'update_profile' gesetzt?
    $name = $_POST['name']; //Holt von jeweiligem Formularfeld die Eingabe und speichert diesen in passender Variable
    $nachname = $_POST['nachname'];
    $age = (int)$_POST['age'];
    $geschlecht = $_POST['geschlecht'];
    $geburtsjahr = (int)$_POST['geburtsjahr'];
    $nationalitaet = $_POST['nationalitaet'];
    $user_email = $_SESSION['user_email'];
    
    //Passwort-Aktualisierung
    if (!empty($_POST['passwort']) && $_POST['passwort'] === $_POST['passwort_wiederholen']) { //Passwortfeld belegt? && Passwörter stimmen über ein?
        $passwort = password_hash($_POST['passwort'], PASSWORD_DEFAULT); //Verschlüsselung von neuem Passwort
    } elseif (empty($_POST['passwort'])) { //Keine Eingabe für neues Passwort
        $stmt = $conn->prepare("SELECT passwort FROM users WHERE email = :email"); //SQL Vorbereitung für ABfrage von aktuellem Passwort
        $stmt->bindParam(":email", $user_email);
        $stmt->execute(); //Ausführung von SQL Code
        $passwort = $stmt->fetchColumn(); //Gibt das bestehende Passwort zurück
    } else {
        $error_message = "Die Passwörter stimmen nicht überein!";
    }
    
    if (!isset($error_message)) { //keine Fehlermeldung bei Passwortaktualisierung
        $stmt = $conn->prepare("UPDATE users SET name = :name, nachname = :nachname, age = :age, geschlecht = :geschlecht, geburtsjahr = :geburtsjahr, nationalitaet = :nationalitaet, passwort = :passwort WHERE email = :email"); //SQL ABfrage
        $stmt->bindParam(":name", $name); //alter Wert wird durch neuen Wert ersetzt/gebunden
        $stmt->bindParam(":nachname", $nachname);
        $stmt->bindParam(":age", $age);
        $stmt->bindParam(":geschlecht", $geschlecht);
        $stmt->bindParam(":geburtsjahr", $geburtsjahr);
        $stmt->bindParam(":nationalitaet", $nationalitaet);
        $stmt->bindParam(":passwort", $passwort);
        $stmt->bindParam(":email", $user_email);
        
        if ($stmt->execute()) { //SQL Abfrage ausführen
            $success_message = "Profil erfolgreich aktualisiert!";
        } else {
            $error_message = "Fehler beim Aktualisieren des Profils: " . implode(', ', $stmt->errorInfo()); //Fehlermeldung mit Fehlerinfo
        }
    }
}

// Profilinformationen abfragen
$user_email = $_SESSION['user_email']; //Mail von Benutzer aus aktueller Session holen
$stmt = $conn->prepare("SELECT name, nachname, age, geschlecht, geburtsjahr, nationalitaet, passwort FROM users WHERE email = :email"); //SQL Abfrage, um Benutzerdaten anhand von Mailadresse abfragen zu können
$stmt->bindParam(":email", $user_email); //Wert von Variable wird durch Wert von email ersetzt für SQL Abfrage
$stmt->execute(); //SQL Abfrage ausführen
$stmt->bindColumn(1, $name); //Wert von Eingabefeld x wird bei Variable gesetzt
$stmt->bindColumn(2, $nachname);
$stmt->bindColumn(3, $age);
$stmt->bindColumn(4, $geschlecht);
$stmt->bindColumn(5, $geburtsjahr);
$stmt->bindColumn(6, $nationalitaet);
$stmt->bindColumn(7, $current_password);
$stmt->fetch(PDO::FETCH_BOUND); //SQL Ergebnis wird neuer Wert bei den oberen Variablen

// Wenn Werte nicht vorhanden sind, Standardwerte setzen
if (!$geburtsjahr) {
    $geburtsjahr = 2000;
}
if (!$nationalitaet) {
    $nationalitaet = "";
}

$countries = [
    "Afghanistan", "Ägypten", "Albanien", "Algerien", "Andorra", "Angola", "Antigua und Barbuda", "Argentinien", "Armenien", "Aserbaidschan", 
    "Äthiopien", "Australien", "Bahamas", "Bahrain", "Bangladesch", "Barbados", "Belarus", "Belgien", "Belize", "Benin", 
    "Bhutan", "Bolivien", "Bosnien und Herzegowina", "Botswana", "Brasilien", "Brunei", "Bulgarien", "Burkina Faso", "Burundi", "Chile", 
    "China", "Costa Rica", "Dänemark", "Demokratische Republik Kongo", "Deutschland", "Dominica", "Dominikanische Republik", "Dschibuti", "Ecuador", "El Salvador", 
    "Eritrea", "Estland", "Fidschi", "Finnland", "Frankreich", "Gabun", "Gambia", "Georgien", "Ghana", "Grenada", 
    "Griechenland", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Indien", "Indonesien", "Irak", 
    "Iran", "Irland", "Island", "Israel", "Italien", "Jamaika", "Japan", "Jordanien", "Kambodscha", "Kamerun", 
    "Kanada", "Kasachstan", "Kenia", "Kirgisistan", "Kiribati", "Kolumbien", "Komoren", "Korea (Nord)", "Korea (Süd)", "Kosovo", 
    "Kuwait", "Laos", "Lettland", "Libanon", "Lesotho", "Liberia", "Libyen", "Liechtenstein", "Litauen", "Luxemburg", 
    "Madagaskar", "Malawi", "Malaysia", "Malediven", "Mali", "Malta", "Marokko", "Marshallinseln", "Mauretanien", "Mauritius", 
    "Mexiko", "Mikronesien", "Moldawien", "Monaco", "Mongolei", "Montenegro", "Mosambik", "Myanmar", "Namibia", "Nauru", 
    "Nepal", "Neuseeland", "Nicaragua", "Niederlande", "Niger", "Nigeria", "Nordmazedonien", "Norwegen", "Oman", "Österreich", 
    "Pakistan", "Palau", "Panama", "Papua-Neuguinea", "Paraguay", "Peru", "Philippinen", "Polen", "Portugal", "Rumänien", 
    "Russland", "Ruanda", "St. Kitts und Nevis", "St. Lucia", "St. Vincent und die Grenadinen", "Samoa", "San Marino", "Sao Tome und Principe", "Saudi-Arabien", "Senegal", "Serbien", 
    "Seychellen", "Sierra Leone", "Singapur", "Slowakei", "Slowenien", "Solomon-Inseln", "Somalia", "Südafrika", "Südsudan", "Spanien", 
    "Sri Lanka", "Sudan", "Suriname", "Eswatini", "Schweden", "Schweiz", "Syrien", "Tadschikistan", "Tansania", "Thailand", 
    "Togo", "Tonga", "Trinidad und Tobago", "Tschad", "Tschechien", "Tunesien", "Türkei", "Turkmenistan", "Tuvalu", "Uganda", 
    "Ukraine", "Ungarn", "Uruguay", "Usbekistan", "Vanuatu", "Vatikanstadt", "Venezuela", "Vereinigte Arabische Emirate", "Vereinigte Staaten", "Vietnam", 
    "Jemen", "Sambia", "Simbabwe"
];
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style_login.css">
</head>
<body>
  <div class="wrapper">
  <div class="sidebarleft">
        <div class="menubar">
            <div class ="menu">
                <a href="ForYou.html" style="font-weight: bold; font-size: x-large;">
                  <img src="https://i.ibb.co/G3ft2KtS/u-Food-Logo.png" alt="Logo nicht gefunde" style="height: 26px; width: 28px;">
                  uFood
                </a>
                <a href="ForYou.html">ForYou</a>
                <a href="Suchfunktion.html">Suche</a>
                <a href="hochladen.php">Hochladen</a>
                <a href="profile.php">Profil</a>
                <a href="Über_uns.html">Über uns</a>
                <button style="background: #000023; padding: 10px; border: none; border-radius: 5px; margin-bottom: 0px;"><a href="index.html" style="font-weight: bold; margin-bottom: 0px; color: white;">Anmelden</a></button>
            </div>
        </div>
    </div>

    <div class="main-content">
      <div class="dashboard-card">
        <h1 class="welcome-header">Profil bearbeiten</h1>
        <form method="post" action="">
          <!-- Eingabefeld Vorname-->
          <label for="name">Vorname:</label>
          <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
          <!-- Eingabefeld Vorname-->
          <label for="nachname">Nachname:</label>
          <input type="text" name="nachname" id="nachname" value="<?php echo htmlspecialchars($nachname); ?>" required>
          <!-- Eingabefeld Alter-->          
          <label for="age">Alter:</label>
          <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($age); ?>" required>
          <!-- Eingabefeld Geschlecht-->          
          <label for="geschlecht">Geschlecht:</label>
          <select name="geschlecht" id="geschlecht" required>
            <option value="männlich" <?php if($geschlecht == "männlich") echo "selected"; ?>>Männlich</option>
            <option value="weiblich" <?php if($geschlecht == "weiblich") echo "selected"; ?>>Weiblich</option>
            <option value="divers" <?php if($geschlecht == "divers") echo "selected"; ?>>Divers</option>
          </select>
          <!-- Eingabefeld Geburtsjahr-->          
          <label for="geburtsjahr">Geburtsjahr:</label>
          <select name="geburtsjahr" id="geburtsjahr" required>
            <?php
            for ($year = 2025; $year >= 1900; $year--) {
              $selected = ($year == $geburtsjahr) ? "selected" : "";
              echo "<option value=\"$year\" $selected>$year</option>";
            }
            ?>
          </select>
           <!-- Eingabefeld Nationalität-->         
          <label for="nationalitaet">Nationalität:</label>
          <select name="nationalitaet" id="nationalitaet" required>
            <?php foreach ($countries as $country): ?>
              <option value="<?php echo htmlspecialchars($country); ?>" <?php if($nationalitaet === $country) echo "selected"; ?>>
                <?php echo htmlspecialchars($country); ?>
              </option>
            <?php endforeach; ?>
          </select>
          <!-- Eingabefeld Passwort1-->          
          <label for="passwort">Neues Passwort (falls ändern gewünscht):</label>
          <input type="password" name="passwort" id="passwort" placeholder="Neues Passwort">
           <!-- Eingabefeld Passwort2-->                   
          <label for="passwort_wiederholen">Passwort wiederholen:</label>
          <input type="password" name="passwort_wiederholen" id="passwort_wiederholen" placeholder="Passwort wiederholen">
          <button type="submit" name="update_profile" class="btn">Profil aktualisieren</button>
        </form>
        <?php if(isset($success_message)) { echo "<p style='color:green;'>$success_message</p>"; } ?>
        <?php if(isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
        <br>
        <a href="ForYou.html" class="btn">Zurück zur ForYou-Page</a>
        </div>
    </div>
  </div>
</body>
</html>
<?php
$conn->close();
?>