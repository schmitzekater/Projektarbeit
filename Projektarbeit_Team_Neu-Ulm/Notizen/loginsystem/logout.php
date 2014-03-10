<?php	
		session_start();
		if (isset($_SESSION['id'])) {
		
			// Sitzungsvariablen löschen
			$_SESSION = array();

			// Sitzungs-Cookie löschen
			if (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 3600);
			}
			session_destroy();
		}

		// Cookies löschen
		setcookie('id', '', time() - 3600);
		setcookie('nutzername', '', time() - 3600);

		$hauptseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header('Location: ' . $hauptseite);
?>
