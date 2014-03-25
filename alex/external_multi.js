function getData() {
	//numRows = 50;
	numRows = $("#rows").val();
	/*
	 * TODO: Hidden Next setzen, damit beim nächsten drücken die nächsten XX Zeilen angezeigt werden.
	 */
	$
			.ajax({
				url : 'api_multi.php', 
				data : "rows="+numRows, 
				dataType : 'json', 
				success : function(data) 
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
					$('#output').html(table); 
				}
			});
}
function toggleElement(elementName) {
	$(elementName).slideToggle(150);
}
