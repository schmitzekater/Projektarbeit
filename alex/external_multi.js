/*$(document).ready(function() {
	var el = document.getElementById("clickMe");

	if (el.addEventListener)
		el.addEventListener("click", getData(), false);
	else if (el.attachEvent)
		el.attachEvent('onclick', getData());
}); */

function getData() {
	//numRows = 50;
	numRows = $("#rows").val();
	/*
	 * TODO: Hidden Next setzen, damit beim nächsten drücken die nächsten XX Zeilen angezeigt werden.
	 */
	$
			.ajax({
				url : 'api_multi.php', // the script to call to
				// get data
				data : "rows="+numRows, // you can insert url
				// argumnets here to pass
				// to api.php
				// for example "id=5&parent=6"
				dataType : 'json', // data format
				success : function(data) // on recieve of
				// reply
				{
					table = "<table border ='1'><tr><td>ID</td><td>Change</td><td>AA Change</td><td>ExtraInfo</td><td>GenId</td><td>Phenotype</td><td>Protein</td><td>Nucleotide</td><td>Ref</td></tr>";
					trStart = "<tr><td>";
					tdMiddle = "</td><td>";
					trEnd = "</td></tr>";
					tableEnd = "</table>";
					$.each(data, function(i, item) {
						table += trStart + data[i].id + tdMiddle
								+ data[i].change + tdMiddle + data[i].aa
								+ tdMiddle + data[i].extra + tdMiddle
								+ data[i].genId + tdMiddle + data[i].pheno
								+ tdMiddle + data[i].protein + tdMiddle
								+ data[i].nuc + tdMiddle + data[i].ref + trEnd;
					});
					table += tableEnd;

					// --------------------------------------------------------------------
					// 3) Update html content
					// --------------------------------------------------------------------
					$('#output').html(table); // Set output
					// element html
					// recommend reading up on jquery selectors
					// they are awesome
					// http://api.jquery.com/category/selectors/
				}
			});
}
function toggleElement(elementName) {
	$(elementName).slideToggle(150);
}
