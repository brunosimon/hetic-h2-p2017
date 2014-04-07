var url = 'tchatAjax.php';

$(function(){
    $('.tchatForm form').submit(function(){

        var message = $('[name="message"]').val();

        $.ajax({
		  url: url,
		  context: document.body,
		  data:{action:'addMessage',message:message},
		  type:'POST'
		}).done(function(res) {
		  $('.debug').html(res);
		  $('.message').val(" ");
		});
        
        return false;
    });

    setInterval(function(){
    	console.log('recup');
		$.ajax({
	        type: "GET",
	        url: "recover.php",
	        success: function(data) {
	        	$('#tchat').html(data);
	            console.log('ok');
	        }
	    });
	}, 1000);

	form.on('submit',function()
            {
                $.ajax({
                    url     : 'tchat.php', 
                    data    : "message="+input.val()+"&pseudo=<?= $_GET['pseudo']; ?>",
                    type    : 'POST', 
                    success : function(res) 
                    {
                        $('input.message').val("");
                    }
                });
                return false;
            });
});





















