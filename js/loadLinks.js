//Folgender Code stammt von : http://think2loud.com/224-reading-xml-with-jquery/
/**
 * Dieses Script liest eine XML-Datei ein, und baut aus dem Inhalt die
 * Link-Liste. Trennung von Darstellung und Inhalt.
 */
$(document).ready(
		function() {
			$.ajax({
				type : "GET",
				url : "./xml/db_sources.xml",
				dataType : "xml",
				success : function(xml) {
					$('<div class="items" id="links"></div>').html('<ul>')
							.appendTo('#subside');
					$(xml).find('link').each(
							function() {
								var title = $(this).find('text').text();
								var url = $(this).find('url').text();
								$('<div class="items" id="links"></div>').html(
										'<li><a href="' + url + '">' + title
												+ '</a></li>').appendTo(
										'#subside');
							});
					$('<div class="items" id="links"></div>').html('</ul>')
							.appendTo('#subside');
				}
			});
		});