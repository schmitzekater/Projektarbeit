/* 
Script made by Martial Boissonneault © 2001-2006 http://getElementById.com
This script may be used and changed freely as long as this msg is intact
Visit http://getElementById.com/ for more free scripts and tutorials.
*/

var ie5 = (document.getElementById && document.all);
var ns6 = (document.getElementById && !document.all);

function setXML(rq){
	var menuTab = rq.responseXML.getElementsByTagName('menu');
	for (var i=0;i<menuTab.length;i++){
		var p = document.createElement('p');
		if(menuTab[i].getAttribute('url') != null){
			var txt = menuTab[i].getAttribute('text');
			p.appendChild(document.createTextNode(String.fromCharCode(187) + " " + txt));
			var url = menuTab[i].getAttribute('url');
			if(url.indexOf("?") > -1){
				p.onclick = new Function("document.location.href = '" + url + "&mn=" + i + "';");
			}else{
				p.onclick = new Function("document.location.href = '" + url + "?mn=" + i + "';");
			}	
		}else{
			var txt = menuTab[i].getAttribute('text');
			p.appendChild(document.createTextNode(String.fromCharCode(187) + " " + txt));
			p.onclick = new Function("switchMenu('sub" + i + "');");
		}
		if(ie5){p.style.cssText= 'width: 100%;';}
		p.setAttribute("id", "menu" + i);
		if (getURLParam('mn')!= ""){
			if (i == getURLParam('mn')){
				ie5?p.setAttribute("className", "menuSelected"):p.setAttribute("class", "menuSelected");
			}else{
				ie5?p.setAttribute("className", "menuOut"):p.setAttribute("class", "menuOut");
				p.onmouseover = new Function("changeClass('menu" + i + "','menuOver');");
				p.onmouseout = new Function("changeClass('menu" + i + "','menuOut');");
			}
		}else{
			ie5?p.setAttribute("className", "menuOut"):p.setAttribute("class", "menuOut");
			p.onmouseover = new Function("changeClass('menu" + i + "','menuOver');");
			p.onmouseout = new Function("changeClass('menu" + i + "','menuOut');");
		}	
		document.getElementById('SwitchMenu').appendChild(p);
		var d = document.createElement('div');
		d.setAttribute("id", "sub" + i);
		ie5?d.setAttribute("className", "submenu"):d.setAttribute("class", "submenu");
		if ( (getURLParam('mn')!= "") && (getURLParam('sm')!= "") ){
			if (i == getURLParam('mn')){
				d.style.cssText = 'display:block;';
			}else{
				d.style.cssText = 'display:none;';
			}
		}else{
			d.style.cssText = 'display:none;';
		}
		document.getElementById('SwitchMenu').appendChild(d);
		var subMenuTab = menuTab[i].getElementsByTagName('submenu');
		for (var j=0;j<subMenuTab.length;j++){
			var a = document.createElement('a');
			var subUrl = subMenuTab[j].getAttribute('url');
			if(subUrl.indexOf("?") > -1){
				a.href = subUrl + "&mn=" + i + "&sm=" + i + "-" + j;
			}else{
				a.href = subUrl + "?mn=" + i + "&sm=" + i + "-" + j;
			}
			var txt = subMenuTab[j].getAttribute('text');
			if (getURLParam('sm')!= ""){
				if (getURLParam('sm') == (i + "-" + j)){
					var spn = document.createElement('span');
					a.appendChild(spn);
					spn.appendChild(document.createTextNode("- " + txt));
					ie5?spn.setAttribute("className", "subMenuSelected"):spn.setAttribute("class", "subMenuSelected");
				}else{
					a.appendChild(document.createTextNode("- " + txt));
				}
			}else{
				a.appendChild(document.createTextNode("- " + txt));
			}
			d.appendChild(a);
			var b = document.createElement('br');
			d.appendChild(b);
		}
	}  
}

var http_request = false;

function ajaxSwitchMenu(url){
	http_request = false;
	if (window.XMLHttpRequest){ 
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType){
			http_request.overrideMimeType('text/xml');
		}
	}else if(window.ActiveXObject){ 
		try{
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
    			http_request = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){}
		}
	}
	if (!http_request) {
		alert('Cannot create an XMLHTTP instance');
		return false;
	}
	http_request.onreadystatechange = displayXML;
	http_request.open('GET', url, true);
	http_request.send(null);
}

function displayXML(){
	if (http_request.readyState != 4) {
		document.getElementById('SwitchMenu').innerHTML = "<div class='loading'>Loading...</div>";
	}else{ 
		if (http_request.status == 200) {
			setTimeout('document.getElementById(\'SwitchMenu\').innerHTML = ""', 1000);
			setTimeout('setXML(http_request)', 1000);
		}else{
			alert('There was a problem with the request.');
		}
	} 
} 

function getURLParam(strParamName){
	var strReturn = "";
	var strHref = window.location.href;
	if(strHref.indexOf("?")>-1){
		var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
		var aQueryString = strQueryString.split("&");
		for (var i=0;i<aQueryString.length;i++){
			if (aQueryString[i].indexOf(strParamName + "=")>-1){
				var aParam = aQueryString[i].split("=");
				strReturn = aParam[1];
				break;
			}
		}
	}
	return strReturn;
} 

function switchMenu(obj){
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("SwitchMenu").getElementsByTagName("DIV");
		if(el.style.display == "none"){
			for (var i=0; i<ar.length; i++){
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}

function changeClass(menu, newClass) { 
	 if (document.getElementById) { 
	 	document.getElementById(menu).className = newClass;
	 } 
} 