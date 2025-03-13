# Webentwicklung
Webentwicklung Gruppenarbeit für Gruppe 6
Für die Entwicklung wurde anstatt der im ACD beschriebenen ABS Cloud XAMPP genutzt.

## 🛠️Verbindung mit der Datenbank:
1. Download der neuesten Version von XAMPP
2. Starten von MySQL und Apache via XAMPP
3. Im Browser öffnen: localhost/phpmyadmin/
4. Datenbank uFoodFinal erstellen
5. Datenbank-Dump "uFoodFinal.sql" ausführen
6. Zip-Ordner "uFood" extrahieren und in C:\xampp\htdocs ablegen
7. Im Browser öffnen: Localhost/uFood/

## 👨‍💻Funktionenübersicht:
**I. Suchfunktion: Alexandra Paparodopoulos**
   🔄 Verwendung:
    1. Suchseite öffnen
    Die Datei Suchseite.html muss im Browser geöffnet werden.
    Die Suchfunktion.php ist in dieser Datei integriert.
    2. Suchbegriff eingeben
    In das Suchfeld kann ein Gericht, Benutzername oder Tag eingegeben werden.
    Die Suche wird entweder per Enter-Taste oder durch Klicken auf den Suchen-Button ausgelöst.
    3. Ergebnisse anzeigen
    Die Suchergebnisse werden dynamisch geladen und als Karten dargestellt.
    Enthalten sind: Gerichtname, User, Tags und ein Vorschaubild (falls vorhanden, sonst Standardbild)
    4. Beitrag aufrufen
    Durch Klicken auf ein Suchergebnis wird die ForYou-Seite mit dem gewählten Beitrag geöffnet.
    
**II. Hochladen: Mirja Bezikofer**
    🔄 Verwendung:
      1.
**III. ForYou Page: Marvin Dörry**
    🔄 Verwendung:
      1.
    ❌ Problem: Kein Algorhithmus wie im ACD geplant umgesetzt.
        Lösung: Anfangs wird zufälliges Video geladen, danach die Datenbank durchgegangen
**IV. Profil / Login / Über uns: Elena Starke**
    🔄 Verwendung:
      1. 
    ❌ Problem: Es wird keine Bestätigungsmail verschickt.
        Ursache: Kein funktionierender E-Mail-Server
        Kurzfristige Lösung: Eine Aktivierungsseite (activation.html) für eine manuelle Bestätigung durch den Benutzer wurde                               erstellt.
        Langfristige Lösung: Ein funktionierender E-Mail-Server sollte eingerichtet werden, um Bestätigungsmails automatisch                               zu versenden und die Benutzerregistrierung zu vollenden.

        
