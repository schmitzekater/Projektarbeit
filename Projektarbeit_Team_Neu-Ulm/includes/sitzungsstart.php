<?php
  session_start();

  // Wenn Sitzungsvariablen nicht gesetzt sind, versuchen sie über Cookies zu setzen
    if (!isset($_SESSION['id'])) {
    if (isset($_COOKIE['id']) && isset($_COOKIE['nutzername'])) {
      $_SESSION['id'] = $_COOKIE['id'];
      $_SESSION['nutzername'] = $_COOKIE['nutzername'];
    }
  }
?>