	var id = 0;

	//Access to ban page
	$('.ban').click(function(){
		window.location.href = "ban.php";
	})


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

	//If on the chat page
	if($('.chat').length){
		$('.chat').append('<div class="welcome">Welcome</div>');
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
						//Get array with id message
						var message = res[i];
						console.log(message);
						//If new message
						if(message.id > id)
						{
							//Change reference id
							id = message.id;  
							$('.chat').append('<div>'+message.id_user+' : '+message.message+'</div>');
						}
					}
				}
			});
		},1000);

	}





