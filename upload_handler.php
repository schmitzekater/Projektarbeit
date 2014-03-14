<!DOCTYPE html>
<!-- Der HTML5-Doctype ist wirklich so simpel. ;) -->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Genetikum - GenetikumDb</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../css/main.css" />
		<link rel="stylesheet" type="text/css" href="../css/footer.css" />
		<!-- <link rel="stylesheet" type="text/css" href="./css/style.css" 	media="screen"> -->
		<script src="./js/jquery.js" type="text/javascript"></script>
		
		<script src="./js/loadLinks.js" type="text/javascript"></script>
	</head>
	<body>
		<!-- div container -->
		<?php
		include "php/nav.php";
		include "php/zugang.php";
		?>
		<section id="content">
			<article>
				<div id="main">
					<?php
						$fn = (isset ( $_SERVER ['HTTP_X_FILENAME'] ) ? $_SERVER ['HTTP_X_FILENAME'] : false);
						if ($fn) {
							
							// AJAX call
							file_put_contents ( $uploadDir . $fn, file_get_contents ( 'php://input' ) );
							echo "$fn uploaded";
							exit ();
						} else {
							// form submit
							$files = $_FILES ['fileselect'];
							
							foreach ( $files ['error'] as $id => $err ) {
								if ($err == UPLOAD_ERR_OK) {
									$fn = $files ['name'] [$id];
									move_uploaded_file ( $files ['tmp_name'] [$id], $uploadDir . $fn );
									echo "<p>File $fn uploaded.</p>";
								}
							}
						}
					?>
				</div> <!-- End main -->
			</article>
		</section>
		<aside>
			<div id="subside">
				<h1>Quellen</h1>
				<!-- Die Links hier werden automatisch mit JavaScript eingelesen. -->
			</div>
		</aside>
		<footer>
			<?php include "php/footer_Seite.php"; ?>
		</footer>
	</div> <!-- End Container -->
</body>
</html>

