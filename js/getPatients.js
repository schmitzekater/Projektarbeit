function getData() {
	//numRows = 50;
	numRows = $("#rows").val();
	/*
	 * TODO: Hidden Next setzen, damit beim nächsten drücken die nächsten XX Zeilen angezeigt werden.
	 */
	$
			.ajax({
				url : 'php/get_patients.php', 
				data : "rows="+numRows, 
				dataType : 'json', 
				success : function(data) 
				{
					table = "<table border='1'><tr><td>Patient Name</td><td>Gene</td><td>Location</td><td>Pos</td><td>AA Change</td><td>Nucleotid Change</td><td>Type</td><td>Hint</td><td>HGVS Nomenclature</td></tr>";
					trStart = "<tr><td>";
					tdMiddle = "</td><td>";
					trEnd = "</td></tr>";
					tableEnd = "</table>";
					$.each(data, function(i, item) {
						table += trStart 
								+ data[i].name  + tdMiddle
								+ data[i].gene  + tdMiddle 
								+ data[i].loc	+ tdMiddle
								+ data[i].pos   + tdMiddle
								+ data[i].achg  + tdMiddle
								+ data[i].nchg  + tdMiddle
								+ data[i].type	+ tdMiddle 
								+ data[i].hint  + tdMiddle
								+ data[i].hgvs	+ trEnd;
					});
					table += tableEnd;
					$('#output').html("<h1>Ergebnis</h1>"+table); 
				}
			});
}
function toggleElement(elementName) {
	$(elementName).slideToggle(150);
}
