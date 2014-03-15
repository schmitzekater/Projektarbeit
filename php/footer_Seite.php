<hr class="linie">
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
<hr class="linie">

