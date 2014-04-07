        /**
         * Code à mettre dans un fichier JS indépendant
         */

        // Récupération du formulaire et du champ de texte
var id = 0;

        // Interval répété toutes les 1000 ms qui s'occupe d'aller chercher les messages
        window.setInterval(function()
        {   


            // Requête ajax
            $.ajax({
                url      : 'receive.php', // Url du script PHP qui va récupérer les messages
                type    : 'POST', 
                dataType : 'json',
                success  : function(res)  // Success (la requête à fonctionné)
                {
                    // console.log('-------');
                    // console.log('Messages :');

                    // Boucle à travers les messages
                    for(var i = 0; i < res.length; i++)
                    {
                        var message = res[i];
                        console.log(res[i]);
                        // Affiche le message dans la console //RES.MESSAGE RESULTAT DU TABLEAU
                        if (message.id > id){

                            id = message.id;
                            $('.chat').append('<div>'+message.login+':'+message.message+'</div>');
                           
                        }
                    }
                }
            });
        },1000);

        // On écoute l'événement submit du formulaire
        $('.sendMessage').click(function()
        {    
        var message = $('.message').val();

            $.ajax({
                url     : 'messages.php',
                type    : 'POST',               // Url du script qui va rajouter le message à la base de données
                data    : {message:message}, // On envoit le message dans les paramètres
                   // Type POST (pas obligatoire)
                // success : function(res)             // Success (la requête à fonctionné)
                // {
                //     console.log(message);
                // }
            });
            return false;
        });

        $('.sendMessage').click(function(){
            document.getElementById("message").value =''; 
        });