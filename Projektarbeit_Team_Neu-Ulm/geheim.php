<?php
 
// Zugangsdaten
$benutzername = 'Otto';
$passwort     = 'geheim';
 
// Session starten
session_start();
 
// Variablen deklarieren
$_SESSION['angemeldet'] = false;
$fehlermeldung          = '';
 
// Wurde das Formular abgeschickt?
if (isset( $_POST['login'] ))
{
    // Maskierende Slashes aus POST Array entfernen
    if (get_magic_quotes_gpc())
    {
        $_POST = array_map( 'stripslashes', $_POST );
    }
    // Benutzereingabe mit Zugangsdaten vergleichen
    if (strtolower( $benutzername ) == strtolower( trim( $_POST['benutzer'] )) &&
        $passwort == trim( $_POST['passwort'] ))
    {
        // Wenn die Anmeldung korrekt war Session Variable setzen
        // und auf die geheime Seite weiterleiten
        $_SESSION['angemeldet'] = true;
        header( 'location: geheim_einfach.php' );
        exit;
    }
    else
    {
        // Wenn die Anmeldung fehlerhaft war, Fehlermeldung setzen
        $fehlermeldung = '<h3>Die Anmeldung war fehlerhaft!</h3>';
    }
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpBuddy.eu - Login Script</title>
</head>
 
<body>
 
<?php
// Falls die Fehlermeldung gesetzt ist
if ($fehlermeldung) echo $fehlermeldung;
?>
 
<form id="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="benutzer">Benutzer: </label><input type="text" name="benutzer" id="benutzer" value="" /><br />
    <label for="passwort">Passwort: </label><input type="password" name="passwort" id="passwort" value="" /><br />
    <input type="submit" name="login" id="login" value="Anmelden" />
</form>
 
</body>
</html>