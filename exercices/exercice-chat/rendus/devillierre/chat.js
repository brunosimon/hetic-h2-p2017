function getXMLHttpRequest() {
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr;
}


function refreshChat()
{
var xhr = getXMLHttpRequest();
xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                document.getElementById('chat').innerHTML = xhr.responseText; // Données textuelles récupérées
        }
};

xhr.open("GET", "chat.php", true);
xhr.send(null);
}

function submitChat()
{
var xhr = getXMLHttpRequest();
var pseudo = encodeURIComponent(document.getElementById('pseudo').value);
var message = encodeURIComponent(document.getElementById('message').value);
document.getElementById('message').value = ""; // on vide le message sur la page

xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                document.getElementById('chat').innerHTML = xhr.responseText; // Données textuelles récupérées
        }
};

xhr.open("POST", "chat.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send("pseudo="+pseudo+"&message="+message);

}
var timer=setInterval("refreshChat()", 5000); // répète toutes les 5s