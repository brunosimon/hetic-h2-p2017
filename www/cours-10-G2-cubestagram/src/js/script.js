var blocks    = null,
    val       = '#tokyo',
    client_id = '5f889f33af784253a5225251213b4efe';

function init()
{
    blocks       = {};
    blocks.form  = $('aside form');
    blocks.input = blocks.form.find('input');
    blocks.erase = blocks.form.find('.erase');

    search();

    blocks.input.on('keyup',function(e)
    {
        val = blocks.input.val();

        if(val !== '#' && val !== '')
            blocks.erase.fadeIn(200);
        else
            blocks.erase.fadeOut(200);

        if(e.keyCode === 13)
            search();
    });

    blocks.input.on('blur',function(e)
    {
        search();
    });

    blocks.erase.on('click',function()
    {
        blocks.erase.fadeOut(200);
        blocks.input.val('#');
    });
}

function search()
{
    clean_val();

    $.ajax({
        dataType : 'jsonp',
        url      : 'https://api.instagram.com/v1/tags/'+val+'/media/recent?client_id='+client_id,
        success  : handle_success,
        error    : handle_error
    });
}

function handle_success(res)
{
    for(var i = 0; i < 6; i++)
    {
        (function()
        {
            var image = new Image(),
                url   = res.data[i].images.standard_resolution.url,
                face  = $('.cube .face').eq(i);

            image.onload = function()
            {
                face.fadeOut(400,function()
                {
                    face.empty();
                    face.append(image);
                    face.fadeIn();
                });
            };

            image.src = url;
        })();
    }
}

function handle_error()
{
    console.log('error');
}

function clean_val()
{
    val = val.trim();
    val = val.replace('#','');
    val = val.toLowerCase();
    val = val.split(' ').shift();

    blocks.input.val(val);
}


$(function()
{
    init();
});
















