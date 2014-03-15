
<hr class="linie">
<<<<<<< HEAD
<div id="a7">
	<table border="0">
		<tr>
			<td width="80%">&copy; Alexander Schmitz & Carolin Schwerdtfeger <br />
				<a href="Impressum.php">Impressum </a>
			</td>
			<td><?php
			$timestamp = time ();
			$tage = array (
					"Sonntag",
					"Montag",
					"Dienstag",
					"Mittwoch",
					"Donnerstag",
					"Freitag",
					"Samstag"
			);
			$datum = date ( "d.m.Y", $timestamp );
			$wochentag = date ( "w", $timestamp );
			$uhrzeit = date ( "H:i", $timestamp );
			echo "Serverzeit: ", $uhrzeit, "<br />", $tage [$wochentag], ", ", $datum;
			?>
			</td>
		</tr>
	</table>
</div>
=======
<div id="a7">Copyright	Alexander Schmitz & Carolin Schwerdtfeger</div>
<hr class="linie">
<p></p>
<hr class="linie">
<div id="a7">F&uuml;r weitere Sequenzinformationen....</div>
<hr class="linie">
<p></p>
<hr class="linie">
<div id="a7">erz&auml;hl mir was neues...</div>
>>>>>>> 294c5a1eb724f4808272d11fcab03e580f9696f1
<hr class="linie">

