
	// B. : Variable qui permettra de sauvegarder le dernier ID affiché
	var id = 0;

	//Receiving message
	window.setInterval(function(){
		$.ajax({
			url: '../../includes/receive.php',
			type: 'POST',
			dataType: 'json',
			success: function(res)
			{
				for(var i = 0; i < res.length; i++)
				{
					var message = res[i]; // B. : On récupère juste le message
					if(message.id > id)   // B. : On test si son ID est supérieur au dernier ID affiché
					{
						id = message.id;  // B. : On sauvegarde le nouvel ID comme étant le dernier affiché
						$('.chat').append('<div>'+message.message+'</div>'); // B. : On affiche le message avec la fonction append de jQuery qui rajoute à la fin
					}
				}
			}
		});
	},1000);

	//Send message
	$('.sendMessage').click(function() {
		//Get value of input
		var message = $('.message').val();

		if(message != null && message != ''){
			$.ajax({
	    		type: "POST",
	    		url: "../../includes/send.php",
	    		data: {message: message},

	    		success: function(){
	    		$('.message').val('');
				},
				error: function(){
				alert('Fail to send message');
				}
	    	})
	    	

	    	return false;			
		}

	})



