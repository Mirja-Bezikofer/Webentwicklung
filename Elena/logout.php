<?php
session_start(); //startet Session
session_destroy(); //löscht alle gespeicherten Daten in der Session
header("Location: index.html"); //Weiterleitung zu Loginseite
?>