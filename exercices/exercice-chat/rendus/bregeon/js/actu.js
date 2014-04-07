    function refreshconnecter(){
     
    $.ajax({ type: "GET", url: "connecter.php", data: "action=refresh", success: function(msg1){ document.getElementById("connecter").innerHTML = msg1; } });
     
    setTimeout("refreshconnecter()",1000);
     
    }
	
    function refreshnombre(){
     
    $.ajax({ type: "GET", url: "nombre.php", data: "action=refresh", success: function(msg2){ document.getElementById("nombre").innerHTML = msg2; } });
     
    setTimeout("refreshnombre()",1000);
     
    }
	
	
	function refreshchat(){
     
    $.ajax({ type: "GET", url: "discution.php", data: "action=refresh", success: function(msg){ document.getElementById("tchat").innerHTML = msg; element = document.getElementById('chat'); element.scrollTop = element.scrollHeight; } });

    setTimeout("refreshchat()",1000);
     
    }
     
    function envoi(){
     
    var message = document.getElementById("message").value;
     
    var pseudo = document.getElementById("pseudo").value;
     
    $.ajax({ type: "GET", url: "discution.php", data: "action=envoi&message="+message+"&pseudo="+pseudo });
    
	document.getElementById("message").value = "";
    }
	

	
		
    function ban(){
     
    var id = document.getElementById("idd").value;

    $.ajax({ type: "GET", url: "panneau/ban.php", data: "action=envoi&id="+id+"" });
    
    }
	
    function efface(){
    
	document.getElementById("message").value = "";
    }

    refreshconnecter();
	refreshnombre();
    refreshchat();
	
