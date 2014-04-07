    function ban(id){
	
    $.ajax({ type: "GET", url: "ban.php", data: "action=envoi&id="+id+"" });
    
    }
	
    function acces(id){
	
    $.ajax({ type: "GET", url: "acces.php", data: "action=envoi&id="+id+"" });
    
    }
	
    function vider(id){
	
    $.ajax({ type: "GET", url: "vider.php", data: "action=envoi&id="+id+"" });
    
    }
	
	function refreshliste(){
     
    $.ajax({ type: "GET", url: "tableau.php", data: "action=refresh", success: function(msg){ document.getElementById("liste").innerHTML = msg; } });

    setTimeout("refreshliste()",1000);
     
    }	
	
	refreshliste();