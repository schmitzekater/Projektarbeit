<?php	
		session_start();
		if (isset($_SESSION['id'])) {
		
			// Sitzungsvariablen l������schen
			$_SESSION = array();

			// Sitzungs-Cookie l������schen
			if (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 3600);
			}
			session_destroy();
		}

		// Cookies l������schen
		setcookie('id', '', time() - 3600);
		setcookie('nutzername', '', time() - 3600);

		$hauptseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header('Location: ' . $hauptseite);
?>

