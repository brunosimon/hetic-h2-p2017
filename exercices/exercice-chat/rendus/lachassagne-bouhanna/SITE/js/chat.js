$(document).ready(function(){

	var input			= $('.write-field'),
			form 			= $('.form-chat'),
			roomId		= $('.hidden-id').val(),
			senderId	= $('.hidden-idSender').val(),
			senderLogin	= $('.hidden-loginSender').val(),
			chat 			= $('.chat');


	form.on('submit',function() {
		$.ajax({
			url     : '../include/send.php', 
			data    : {message: input.val(), room: roomId, idSender: senderId, login: senderLogin},
			type    : 'POST',
			success : function(res) {
				input.val('');
				console.log('ok');
			}
		});
		return false;
	});

	window.setInterval(function() {
		$.ajax({
			url      	: '../include/receive.php',
			dataType 	: 'json',
			data 		: {id: roomId},
			type 		: 'POST',
			success  	: function(res)
			{
				console.log('ok');
				chat.html('');
				for(var i = 0; i < res.length; i++) {
					if(senderId == res[i].senderId) {
						chat.append("<div class='message right'><p class='size'>"+res[i].content+"</p><hr><strong>"+res[i].login+"</strong><br/>"+res[i].date+"</div><br/>")
					} else {
						chat.append("<div class='message left'><p class='size'>"+res[i].content+"</p><hr><strong>"+res[i].login+"</strong><br/>"+res[i].date+"</div><br/>")
					}
				}
			},
			error  	: function() {
				console.log('not ok');
			}
		});
	},300);

})