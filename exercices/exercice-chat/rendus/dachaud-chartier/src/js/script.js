var container = document.getElementById('container');
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
                    $("#container").html('<p>');

                    // Boucle à travers les messages
                    for(var i = 0; i < res.messages.length; i++)
                    {
                        if(res.messages[i].id == 1){
                            if(res.messages[i].param1 == 'new_kest'){
                                // Affiche la question
                                $("#container").append('<div class="mes_question"><span class="tchat_console_titre">Question ' + res.messages[i].param2 + ' : </span><span class="tchat_console_question">' + res.messages[i].message+ '</span></div>');
                            } else if(res.messages[i].param1 == 'time_up'){
                                // Affiche le message de fin de question parcequ'il y pa plus de temps
                                $("#container").append('<div class="mes_time"><span class="tchat_console_question">Temps écoulé ! La réponse était : &laquo;</span><span class="tchat_console_titre">' + res.messages[i].param2+ '</span><span class="tchat_console_question">&raquo;</span></div>');
                            } else if(res.messages[i].param1 == 'win'){
                                // Affiche le message de fin de question parcequ'il y pa plus de temps
                                $("#container").append('<div class="mes_time"><span class="tchat_console_question">Réponse trouvée par </span><span class="tchat_console_titre">' + res.messages[i].message+ '</span><span class="tchat_console_question"> ! &laquo;</span><span class="tchat_console_titre">' + res.messages[i].param2+ '</span><span class="tchat_console_question">&raquo;</span></div>');
                            } else if(res.messages[i].param1 == 'end'){
                                // Affiche le message de fin de question parcequ'il y pa plus de temps
                                $("#container").append('<div class="mes_time"><span class="tchat_console_question">QUIZ TERMINÉ ! Bravo à </span><span class="tchat_console_titre">' + res.messages[i].message+ '</span><span class="tchat_console_question"> qui remporte la partie avec </span><span class="tchat_console_titre">' + res.messages[i].param2+ 'pts</span><span class="tchat_console_question"> !<br/><br/>Un prochain quiz va débuter dans 30 secondes !</span></div>');
                            }
                            
                        } else {
                            // Affiche le message dand le tchat
                            $("#container").append('<span class="tchat_user_pseudo">' + res.messages[i].pseudo + ' : </span><span class="tchat_user_message">' + res.messages[i].message+ '</span><br/>');
                        }
                    }

                    $("#timer").animate({'height': (((15 - res.timeleft)/15)*100) + '%'}, 100);

                    if (res.num_kestion == 0){
                        $(".question .title1").html("Pause ! Préparez-vous, la prochaine question arrive dans moins de 15 secondes !");
                    } else {
                        $(".question .title1").html("Question "+ res.num_kestion +" :");
                    }
                    $(".question .txt_question").html(res.mes_kestion);

                    //alert(res.scores.length);
                    $("#class1").html("");
                    $("#class2").html("");
                    for(var i = 0; i < res.scores.length; i++)
                    {

                            truc = '';
                            if (res.scores[i].score >= 2){
                                truc = "s";
                            }
                            if(i >= 3){
                                if(i <= 9){
                                    $("#class1").append('<tr><td class="place">'+ (i+1) +'.</td><td class="pseudo">'+res.scores[i].pseudo+'</td><td class="points">'+res.scores[i].score+'pt'+truc+'</td></tr>');
                                } else {
                                    $("#class2").append('<tr><td class="place">'+ (i+1) +'.</td><td class="pseudo">'+res.scores[i].pseudo+'</td><td class="points">'+res.scores[i].score+'pt'+truc+'</td></tr>');
                                }
                            } else {
                                $("#podium_"+ (i+1)).html('<p><span class="txt">'+res.scores[i].pseudo+'</span></p><p><span class="txt">'+res.scores[i].score+'</span><span class="pts">pt'+truc+'</span></p>');
                            }
                    }
                    

                    $("#container").append('</p>');
                    $("#container").append('<br/>');
                    document.getElementById('container_messages').scrollTop = 80000;
                }
            });
        },1000);

        // On écoute l'événement submit du formulaire
        form.on('submit',function()
        {
            $.ajax({
                url     : 'send.php',               // Url du script qui va rajouter le message à la base de données
                encoding:  "UTF-8",
                data    : 'message=' + input.val(), // On envoit le message dans les paramètres
                type    : 'POST',                   // Type POST (pas obligatoire)
                success : function(res)             // Success (la requête à fonctionné)
                {
                    console.log(res);
                    document.getElementById('champ_text').value = '';
                }
            });

            return false;
        });