//On ready version jQuery
$(function()
{
    // Initialisation des variables
    var form      = $('aside form'),
        erase     = form.find('.erase'),
        input     = form.find('input'),
        val       = '#tokyo',
        client_id = '5f889f33af784253a5225251213b4efe';
    
    search();

    // Ecoute l'evenement 'click' sur erase
    erase.on('click',function(e)
    {
        input.val('#');
        val = '#';
        erase.fadeOut(100);

        return false;
    });

    // Ecoute l'evenement 'keyup' sur input
    input.on('keyup',function(e)
    {
        val = input.val();
        if(val !== '#')
            erase.fadeIn(100);

        if(e.keyCode === 13)
        {
            search();
        }
    });

    // Ecoute l'evenement 'blur' sur input
    input.on('blur',function()
    {
        search();
    });

    // Search on instagram
    function search()
    {
        clean_val();

        $.ajax({
            url      : 'https://api.instagram.com/v1/tags/'+val+'/media/recent?client_id='+client_id,
            dataType : 'jsonp',
            success  : handle_success,
            error    : handle_error
        });
    }

    // Handle success
    function handle_success(result)
    {
        for(var i = 0; i < 6; i++)
        {
            (function(){
                var image = new Image(),
                    url   = result.data[i].images.standard_resolution.url,
                    face  = $('.cube .face').eq(i);

                

                image.onload = function()
                {
                    face.fadeOut(400,function()
                    {
                        face.empty();
                        face.append(image);
                        face.fadeIn(400);
                    });
                };

                image.src = url;
            })();
        }
    }

    // Handle error
    function handle_error()
    {
        console.log('error');
    }

    // Clean value
    function clean_val()
    {
        val = val.trim();
        val = val.split(' ').shift();
        val = val.replace('#','');

        input.val('#'+val);
    }
});








