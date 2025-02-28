<?php
//Eingabe der Parameter um Verbindung herzustellen
$servername = "127.0.0.1";
$username = "testuser"; 
$password = "testuser"; 
$dbname = "uFood"; 

// Verbindung herstellen
$connection = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($connection->connect_error) {
    die("Verbindung fehlgeschlagen: " . $connection->connect_error);
}

// SQL um Alergene zu erhalten
$sql = "SELECT Tagname FROM tags WHERE TagArt = 'Alergene'";
$result = $connection->query($sql);

    // Daten in einem Array speichern
    while($row = $result->fetch_assoc()) {
        $alergene[] = $row["Tagname"];
    }

// SQL um Kategorien zu erhalten
$sql = "SELECT Tagname FROM tags WHERE TagArt = 'Land'";
$result = $connection->query($sql);

// Daten in einem Array speichern
while($row = $result->fetch_assoc()) {
    $kategorien[] = $row["Tagname"];
}


// Verbindung schließen
$connection->close();
?>

<html>
<head>
    <title>new Post</title>
    <link rel="stylesheet" href="side.css">
</head>
<body>
<script src="side.js"></script>

    <h1>Teile dein Gericht</h1>
    <p>Name des Gerichts:</p> <input type="text" name="nameG" id="nameG">
    <div class="dropdown">
    <button type = 'button' onclick = 'openAl("alergene")'>Alergene</button>
        <div class="dropdown-content" id="alergene">
    <?php
        // PHP-Code, um die Tags als Optionen in das Dropdown-Menü einzufügen
        foreach ($alergene as $alergen) {
        echo "<option value='$alergen'>$alergen</option>";
        }
        ?>
    </div>
    </div>
    
    <div class="dropdown">
    <button type = 'button' onclick = 'openAl("categories")'>Kategorien</button>
        <div class="dropdown-content" id="categories">
    <?php
        // PHP-Code, um die Tags als Optionen in das Dropdown-Menü einzufügen
        foreach ($kategorien as $kategorie) {
        echo "<option value='$kategorie'>$kategorie</option>";
        }
        ?>
    </div>
    </div>

    <p>Beschreibung des Gerichts:</p> <input type="text" name="Beschreibung" id="beschr">

    </body>
    </html>
