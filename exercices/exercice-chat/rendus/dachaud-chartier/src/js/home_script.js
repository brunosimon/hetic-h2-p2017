var link = document.getElementById('home_already');
var affich = 1;

link.onclick = function(){
	if (affich == 1){
		$('#home_repeat').animate({
	 		height: '0px',
	 		paddingTop: '0px',
	 		paddingBottom: '0px',
	 		marginTop: '0px',
	 		opacity: 0
		}, 500, function() {});

		$('#home_already').html("Je n'ai pas de compte");
		affich = 0;
		document.getElementById('actions').value="connect";
	} else {
		$('#home_repeat').animate({
	 		height: '10px',
	 		paddingTop: '1%',
	 		paddingBottom: '1%',
	 		marginTop: '1%',
	 		opacity: 1
		}, 500, function() {});

		$('#home_already').html("J'ai déjà un compte");
		affich = 1;
		document.getElementById('actions').value="register";
	}
}