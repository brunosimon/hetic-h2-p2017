<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Miaou</title>
</head>
<body>

    <!-- Notre formulaire -->
    <form action="#">
        <input type="text" name="text">
        <input type="submit">
    </form>

    <!-- Code ne fonctionnant pas sans jQuery -->
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>

        /**
         * Code à mettre dans un fichier JS indépendant
         */

        // Récupération du formulaire et du champ de texte
        var form  = $('form'),
            input = form.find('input[type=text]');

        // Interval répété toutes les 1000 ms qui s'occupe d'aller chercher les messages
        window.setInterval(function()
        {
            // Requête ajax
            $.ajax({
                url      : 'receive.php', // Url du script PHP qui va récupérer les messages
                dataType : 'json',        // Format json (objet)
                success  : function(res)  // Success (la requête à fonctionné)
                {
                    console.log('-------');
                    console.log('Messages :');

                    // Boucle à travers les messages
                    for(var i = 0; i < res.messages.length; i++)
                    {
                        // Affiche le message dans la console
                        console.log(' - ' + res.messages[i].pseudo + ' : ' + res.messages[i].message);
                    }
                }
            });
        },1000);

        // On écoute l'événement submit du formulaire
        form.on('submit',function()
        {
            $.ajax({
                url     : 'send.php',               // Url du script qui va rajouter le message à la base de données
                data    : 'message=' + input.val(), // On envoit le message dans les paramètres
                type    : 'POST',                   // Type POST (pas obligatoire)
                success : function(res)             // Success (la requête à fonctionné)
                {
                    console.log(res);
                    alert('message envoyé');
                }
            });

            return false;
        });

    </script>
    
</body>
</html>