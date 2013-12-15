/*
 * VARIABLES
 * Create variables out of the scope
 */
var blocks    = {},
    client_id = '5f889f33af784253a5225251213b4efe',
    faces     = null;

/*
 * INIT
 * Set objets and listen to events
 */
function init()
{
    // Set variables
    blocks.form  = $('aside form');
    blocks.input = $('aside form input[type=text]');
    blocks.erase = $('aside form .erase');
    faces        = [$('.face.top'),$('.face.bottom'),$('.face.left'),$('.face.right'),$('.face.front'),$('.face.back')];

    // Input
    // Focus at start and listen to keyup event
    blocks.input.focus().val(blocks.input.val());
    blocks.input.on('keyup',function(e)
    {
        if(blocks.input.val() === '')
            blocks.erase.fadeOut(100);
        else
            blocks.erase.fadeIn(100);
    });

    // Erase
    // Listen to click
    blocks.erase.on('click',function(e)
    {
        blocks.input.val('');
        blocks.erase.fadeOut(100);
    });
    
    // Form
    // Listen to submit
    blocks.form.on('submit',function(e)
    {
        search(blocks.input.val());
        return false;
    });

    search(blocks.input.val());
}

/*
 * SEARCH
 * Clean value et make request
 */
function search(value)
{
    //Clear cube
    for(var i = 0; i < faces.length; i++)
    {
        faces[i].fadeOut(500,function()
        {
            $(this).empty();
        });
    }

    //Request
    value = clear_search(value);
    $.ajax({
        url      : 'https://api.instagram.com/v1/tags/'+value+'/media/recent?client_id='+client_id,
        dataType : 'jsonp',
        success  : handle_result,
        error    : handle_error
    });
}

/*
 * CLEAR SEARCH
 * Remove useless spaces, remove # and keep only one work
 */
function clear_search(input)
{
    input = input.trim();
    input = input.replace('#','');
    input = input.split(' ').shift(),

    blocks.input.val('#'+input);

    return input;
}

/*
 * HANDLE RESULT
 * Check if result if OK
 * If so, put it in the cube
 */
function handle_result(result)
{
    if(result.data && result.data.length > 6)
    {
        for(var i = 0; i < 6; i++)
        {
            (function()
            {
                var image = new Image(),
                    face  = faces[i];

                image.onload = function()
                {
                    console.log('ok');
                    face.append(image);
                    face.fadeIn(500);
                };

                image.src = result.data[i].images.standard_resolution.url + '?cb='+Math.random();
            })();
        }
    }
    else
    {
        alert('Pas assez de résultat :(');
    }
}

/*
 * HANDLE ERROR
 * Alert if ajax error
 */
function handle_error(error)
{
    alert('Error :(');
}

/*
 * Document ready (jquery version)
 */
$(function()
{
    init();
});