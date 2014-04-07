var reloadTime = 500;
var scrollBar = false;
var punchlines = [	'Si la merde rajeunissait, tu serais immortel.',
					'Tu sais pas qui je suis ? Google-moi !', 
					'Tu parles de swag en boucle, t’es juste un genre de plouc.',
					'Y’a que ma mère qui peut me marcher dessus car le paradis est sous ses pieds.',
					'Le savoir est une arme, je suis calibré, je lis pas de bouquin.',
					'Souhaite moi longue vie, me souhaite pas bonne année.',
					'Coupe toi une jambe si tu veux repartir du bon pied.',
					'J’ai couru comme un esclave pour marcher comme un roi.',
					'J’suis number one, premier d’la classe donc je ne copie pas.',
					'On t’auras à coup de billets fais pas la belle !',
					 ];

$(function() {

	if(document.getElementById('message')) {
		window.setInterval(getMessages, reloadTime);
		$("#message").focus();
		$('#send-punchline').click(function() { sendPunchline() });
	}
});

function sendPunchline() {
	var r = parseInt(Math.random()*punchlines.length);
	console.log(r);
	var punchline = punchlines[r]
	$.ajax({
		type: "POST",
		url: "phpscripts/post-message.php",
		data: "message="+punchline,
		success: function(msg){
			console.log('ok');
		},
		error: function(msg){
			alert('Erreur');
		}
	});
}

function insertLogin(login) {
	var $message = $("#message");
	$message.val($message.val() + login + '> ').focus();
}

function getMessages() {
	$.getJSON('phpscripts/get-message.php?dateConnexion='+$("#dateConnexion").val(), function(data) {
			if(data['error'] == '0') {

				var container = $('#text');
  				var content = $('#messages_content');
				var height = content.height()-500;
				var toBottom;

				if(container[0].scrollTop == height)
					toBottom = true;
				else
					toBottom = false;

					console.log(data);	
				$("#text").html(data['messages']);

  				content = $('#messages_content');
				height = content.height()-500;
				
				if(toBottom == true)
					container[0].scrollTop = content.height();	
  
   				if(scrollBar != true) {
					container[0].scrollTop = content.height();
					scrollBar = true;
				}	
			} else if(data['error'] == 'unlog') {
				$("#annonce").html('');
				$("#text").html('');
				$(location).attr('href',"chat.php");
			}
	});
}

function postMessage() {

	var message = encodeURIComponent($("#message").val());
	$.ajax({
		type: "POST",
		url: "phpscripts/post-message.php",
		data: "message="+message,
		success: function(msg){

			if(msg == true) {
				$("#message").val('');
				$("#responsePost").slideUp("slow").html('');
			} else
				$("#responsePost").html(msg).slideDown("slow");
			$("#message").focus();
		},
		error: function(msg){
			alert('Erreur');
		}
	});
}

function getOnlineUsers() {
	$.getJSON('phpscripts/get-online.php', function(data) {

		if(data['error'] == '0') {		
			var online = '', i = 1, image, text;
			for (var id in data['list']) {
				if(data["list"][id]["status"] == 'busy') {
					text = 'Occup&eacute;';
					statusClass = 'busy';
				} else if(data["list"][id]["status"] == 'inactive') {
					text = 'Absent';
					statusClass = 'inactive';
				} else {
					text = 'En ligne';
					statusClass = 'active';
				}
				online += '<a href="#post" onclick="insertLogin(\''+data['list'][id]["login"]+'\')" title="'+text+'">';
				online += '<span class="status-'+statusClass+'"></span>';
				online += data['list'][id]["login"]+'</a>';
		
				if(i == 1) {
					i = 0;	
					online += '<br>';
				}
				i++;		
			}
			$("#users").html(online);
		} else if(data['error'] == '1')
			$("#users").html('<span style="color:gray;">Aucun utilisateur connect&eacute;.</span>');
	});
}

window.setInterval(getOnlineUsers, reloadTime); 

function setStatus(status) {
	$.ajax({
		type: "POST",
		url: "phpscripts/set-status.php",
		data: "status="+status.value,
		success: function(msg){
			$("#statusResponse").html('<span style="color:green">Le statut a &eacute;t&eacute; mis &agrave; jour</span>');
			setTimeout(rmResponse, 3000);
		},
		error: function(msg){
			$("#statusResponse").html('<span style="color:orange">Erreur</span>');
			setTimeout(rmResponse, 3000);
		}
	});
}

function rmResponse() {
	$("#statusResponse").html('');
}