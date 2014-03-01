// Session starten
session_start();
// Prüfen ob der Benutzer angemeldet ist
if (!$_SESSION['angemeldet'])
{
    // Zum Login umleiten
    header( 'location: login_einfach.php' );
    exit;
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpBuddy.eu - Geheime Seite</title>
</head>
 
<body>
 
<h3>Willkommen im geschützten Bereich! ;-)</h3>
 
</body>
</html>