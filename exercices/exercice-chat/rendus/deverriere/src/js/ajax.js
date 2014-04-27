$(function(){
   
    var form  = $('.tchat-form form');

    var old_res={
        messages:[]
    };

    window.setInterval(function()
    {
        // Requête ajax
        $.ajax({
            url      : './src/includes/receive.php', 
            dataType : 'json',        
            success  : function(res)  
            {
                if(res.messages.length!=old_res.messages.length){
                    var displayMessage = "";
                    // Boucle à travers les messages
                    for(var i = 0; i < res.messages.length; i++)
                    {
                        displayMessage += ' - ' + res.messages[i].pseudo + ' : ' + res.messages[i].content + "<br/>";
                    }
                    $(".tchat").html(displayMessage);
                    
                    $('.tchat').animate({scrollTop:9999999999},0);
                    
                    console.log(res);
                    console.log(old_res);
                } 
                old_res=res;    
            }
        });
    },1000);

    // On écoute l'événement submit du formulaire
    form.on('submit',function()
    {
		if(!($('.content').val() == ''))
		{
			$.ajax({
				url     : './src/includes/send.php',               // Url du script qui va rajouter le message à la base de données
				data 	: form.serialize(), // On envoit le message dans les paramètres
				type    : 'POST',                   // Type POST (pas obligatoire)
				success : function(res)             // Success (la requête à fonctionné)
				{
					console.log(res);
					// on mettra à jour sessionConnect ici
				}
			});
		}
 		else
		{
			alert('Message vide !');
		}
		
		$('.content').val('');
		
        return false;
    });

});