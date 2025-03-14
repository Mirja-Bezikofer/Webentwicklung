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
    Enthalten sind: Gerichtname, User, Tags und ein Vorschaubild (falls vorhanden, sonst Standardbild).
    4. Beitrag aufrufen
    Durch Klicken auf ein Suchergebnis wird die ForYou-Seite mit dem gewählten Beitrag geöffnet.
    
**II. Hochladen: Mirja Bezikofer**
    🔄 Verwendung:
      1. Hochladen öffnen
      Die Datei Hochladen.php muss im Browser geöffnet werden.
      2. Formular ausfüllen
      Eingabefelder: Video hochladen, Gerichtname (optional), Tags (optional), Vorschaubild (optional).
      3. Post hochladen
      Die Datei wird verarbeitet und in der Datenbank gespeichert.

**III. ForYou Page: Marvin Dörry**
    🔄 Verwendung:
      1.
    ❌ Problem: Kein Algorhithmus wie im ACD geplant umgesetzt.
        Lösung: Anfangs wird zufälliges Video geladen, danach die Datenbank durchgegangen
        
**IV. Profil / Login / Über uns: Elena Starke**
    🔄 Verwendung:
      1. Register: localhost/ufood/Dateipfad/Login_Profile_Registrierung/register.html aufrufen
      Benutzername: tester 	Test-Email: tester@test.de		Passwort: test2
            a)	Benutzername: tester1 ->Fehlermeldung, weil bereits registriert
            b)	Mail ohne @ oder. ->Fehlermeldung
      2. Login: localhost/ufood/Dateipfad/Login_Profile_Registrierung/index.html aufrufen
      Test-Email: tester@test.de		Passwort: test2
            a)	Mail ohne @ oder. ->Fehlermeldung
      3. Profil: localhost/ufood/Dateipfad/profile.php aufrufen
            a) Neues Passwort1: test3 		Neues Passwort2: test3 
            b) Neues Passwort1: test 4		Neues Passwort2: test3 Fehlermeldung
            c) Zum Ausloggen, bitte auf Abmeldebutton klicken 
      4. Über_uns: localhost/ufood/Dateipfad/über_uns.html aufrufen
            a) Zum Ausloggen, bitte auf Abmeldebutton klicken
    ❌ Problem: Es wird keine Bestätigungsmail verschickt.
        Ursache: Kein funktionierender E-Mail-Server
        Kurzfristige Lösung: Eine Aktivierungsseite (activation.html) für eine manuelle Bestätigung durch den Benutzer wurde erstellt.
        Langfristige Lösung: Ein funktionierender E-Mail-Server sollte eingerichtet werden, um Bestätigungsmails automatischh zu versenden und die Benutzerregistrierung zu vollenden.

        
