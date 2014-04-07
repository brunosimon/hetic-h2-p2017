var reloadTime = 1000;
var scrollBar = false;

$(document).ready(function(){

    $.ajax({
        url : "getPost.php",
        type : "JSON",
        success : function(data){$('.chat-zone').html(jQuery.parseJSON(data)); }
    });






});

function refreshPage(){ location.reload(); }

$('#message-button').click(function(e){

    e.preventDefault();

    var message = encodeURIComponent($("#message").val());

    $.ajax({
        url : "getPost.php",
        type : "JSON",
        success : function(data){$('.chat-zone').html(jQuery.parseJSON(data)); }
    });


    $.ajax({
        type: "POST",
        url: "sendPost.php",
        data: "message="+decodeURIComponent(message),
        success: function(){
        $("#message").val('');
        },
        error: function(msg){

            alert('Erreur');
        }
    });





});