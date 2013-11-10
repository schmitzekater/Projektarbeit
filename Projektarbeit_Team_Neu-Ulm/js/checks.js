/**
 * Verschiedenen Checks werden in diese Datei ausgelagert
 * 
 **/
function checkFormular() {
	alert("Huhu Uhu!!");
	if (document.login.name.value.length < 1) {
		document.login.name.select();
		document.logon.name.value = "Gib was ein";
		return false;
	} else {
		return true;
	}
	
}

function popuptest(){
	alert("Huhu Uhu!!");
}
