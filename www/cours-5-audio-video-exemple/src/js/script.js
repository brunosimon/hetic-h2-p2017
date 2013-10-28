var video = document.getElementById('video');
console.log(video);
video.addEventListener('seeking',function()
{
    console.log('1');
});

function init_custom_players()
{
    $('video.custom').each(function()
    {
        var video    = $(this),
            elements = create_custom_elements(video);

        video[0].addEventListener('seeking',function()
        {
            console.log('1');
        });
        video[0].addEventListener('canplaythrough',function()
        {
            console.log('2');
        });
        // set_custom_elements(elements);
    });
}

function set_custom_elements(elements)
{
    elements.video.removeAttr('controls');

    elements.container.css({
        width  : elements.video[0].videoWidth,
        height : elements.video[0].videoHeight
    });

    elements.video[0].play();
    elements.video[0].volume = 0;
}

function create_custom_elements(video)
{
    var container        = $('<div class="container custom-video"></div>'),
        controls         = $('<div class="controls" />'),
        play             = $('<div class="play-pause play" />'),
        seekbar          = $('<div class="seekbar" />'),
        seekbar_played   = $('<div class="seekbar-played" />'),
        seekbar_buffured = $('<div class="seekbar-buffured" />'),
        volume           = $('<div class="volume" />'),
        volume_btn       = $('<div class="volume-btn" />'),
        volume_bar       = $('<div class="volume-bar" />'),
        volume_current   = $('<div class="volume-current" />'),
        fullscreen       = $('<div class="fullscreen" />');

    //Container
    container = video.wrap(container).parent();

    //Seekbar
    seekbar.append(seekbar_buffured);
    seekbar.append(seekbar_played);
    controls.append(seekbar);

    //Volume
    volume.append(volume_btn);
    volume.append(volume_btn);
    controls.append(volume);

    //Play
    controls.append(play);

    //Fullscreen
    controls.append(fullscreen);

    //Controls
    container.append(controls);

    return {
        video            : video,
        container        : container,
        controls         : controls,
        play             : play,
        seekbar          : seekbar,
        seekbar_played   : seekbar_played,
        seekbar_buffured : seekbar_buffured,
        volume           : volume,
        volume_btn       : volume_btn,
        volume_bar       : volume_bar,
        volume_current   : volume_current,
        fullscreen       : fullscreen
    };
}


$(function()
{
    init_custom_players();
});