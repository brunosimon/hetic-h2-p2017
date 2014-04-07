$(function() {
    var formulaire = $('#send_message');

    // Send a Message
    formulaire.on('submit', function(){
        var message = $('.the-message').val();
		$.ajax({
        	url: '../php/chatAjax.php',
        	type: 'POST',
        	data: {message: message},
        })
        .done(function(res) {
        	$('.the-message').val('');
        	console.log(res);
        });
		                
        return false;
    });  


    
    // Receive Message
    setInterval(function(){
    	$.ajax({
    		url: '../php/reviewChat.php',
    		dataType: 'json'
    	})
    	.done(function(res) {
    		console.log(res);
    		var msg = "";
    		$('#messages').html('');   	

    		for(var i = 0; i< res.length; i++){    		
                msg += '<div class="pseudo">'+ res[i].nickname + '</div> <div class="date">'+res[i].date+'</div><div class="message">' +res[i].message+'</div><br/>';
    		}

    		$('#messages').html(msg);
    	});
    }, 1000);
});

//Essai émoticons
// $(document).ready(function() {

    $('.button_smiley').click(function(){
        var smiley = $(this).attr('smiley');
        var message = $('.the-message').val();
        $('.the-message').val(message + ' ' + smiley + ' ');

    });

    $('.the-message').keyup(function(e) {
        if (e.keyCode == 13) {

            var message = $(this).val();

            $.POST('replace.php', {message: message}, function(data){
                $('.messages').append(data + '<br/></br>');
            });
        }
    });






//Essai prévisualisation direct de l'image sans rafraichissement...échec


// // Je cherche l'élément qui a l'id "file" (l'input donc).
// var input = document.getElementById('file');

// // rajout d'un évènement :
// // dès que l'input #file (id file => donc l'input) change, on lance la fonction handleFileSelect;
// input.addEventListener('change', handleFileSelect, false);




// function handleFileSelect(e) {
//         var files = e.target.files;
//         //console.log('change');
//     }

//     for (var i = 0, f; f = file[i]; i++) {

//       // Only process image files.
//       if (!f.type.match('image.*')) {
//         continue;
//       }

//       var reader = new FileReader();

//       // Closure to capture the file information.
//       reader.onload = (function(theFile) {
//         return function(e) {
//           // Render thumbnail.
//           document.getElementById('container_image').innerHTML = "<img src='"+ e.target.result +"'/>";
//         };
//       })(f);

//       // Read in the image file as a data URL.
//       reader.readAsDataURL(f);
//     }

//   document.getElementById('files').addEventListener('change', handleFileSelect, false);