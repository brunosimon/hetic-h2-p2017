/*
 * Code by Bruno SIMON
 * Form HETIC - P2017
 */
$(function()
{
    init_custom_players();
});

/*
 * Initialize player
 */
function init_custom_players()
{
    //For each <video> with 'custom' class
    $('video.custom:not(.customized)').each(function()
    {
        var video    = $(this),
            elements = create_custom_elements(video);

        //Wait for meta before setting up
        video[0].addEventListener('loadedmetadata',function()
        {
            set_custom_elements(elements);
            set_events_and_interactions(elements);
            elements.controls.fadeIn();
        });
    });
}

/*
 * Listen to event and add interactions
 */
function set_events_and_interactions(elements)
{
    /*
     * Progress
     */
    elements.video[0].addEventListener('progress',function(e)
    {
        elements.seekbar_buffured.css({
            width: Math.ceil(elements.video[0].buffered.end(0) / elements.video[0].duration * 100) + '%'
        });
    });

    /*
     * Played bar
     */
    window.setInterval(function()
    {
        elements.seekbar_played.css({
            width: elements.video[0].currentTime / elements.video[0].duration * 100 + '%'
        });
    },20);

    /*
     * Volume
     */
    var volume_current    = elements.video[0].volume;

    elements.volume.on('mouseenter mouseleave',function(e)
    {
        switch(e.type)
        {
            case 'mouseenter':
                elements.volume_bar.show();
                break;
            case 'mouseleave':
                elements.volume_bar.hide();
                break;
        }
    });

    elements.volume_btn.on('click',function(e)
    {
        var volume = null;

        if(elements.video[0].volume === 0)
        {
            volume = volume_current;
            elements.volume_btn.removeClass('icon-volume-off').addClass('icon-volume-up');
        }
        else
        {
            volume = 0;
            elements.volume_btn.removeClass('icon-volume-up').addClass('icon-volume-off');
        }

        elements.video[0].volume = volume;
        elements.volume_current.css({
            height: volume * 100
        });
    });

    elements.volume_bar.on('mouseenter mouseleave mousemove click',function(e)
    {
        var height = null,
            volume = null;

        switch(e.type)
        {
            case 'click':
                height         = (elements.volume_bar.height() - (e.clientY - elements.volume_bar.offset().top)),
                volume         = height / 100;
                volume_current = volume;

                elements.video[0].volume = volume;
                elements.volume_current.css({
                    height: height
                });
                break;
            case 'mouseenter':
                elements.volume_cursor.show();
                break;
            case 'mouseleave':
                elements.volume_cursor.hide();
                break;
            case 'mousemove':
                height = (e.clientY - elements.volume_bar.offset().top);
                elements.volume_cursor.css({
                    top : height
                });
                break;
        }
    });

    /*
     * Play button + Video
     */
    elements.video.on('click',function()
    {
        if(elements.video[0].paused)
            elements.video[0].play();
        else
            elements.video[0].pause();
    });

    elements.video[0].addEventListener('play',function(e)
    {
        elements.play.addClass('icon-pause').removeClass('icon-play');
    });

    elements.video[0].addEventListener('pause',function(e)
    {
        elements.play.addClass('icon-play').removeClass('icon-pause');
    });

    elements.play.on('click',function()
    {
        if(elements.video[0].paused)
            elements.video[0].play();
        else
            elements.video[0].pause();
    });

    /*
     * Seek bar
     */
    elements.seekbar.on('mouseenter mouseleave mousemove click',function(e)
    {
        switch(e.type)
        {
            case 'click':
                var ratio = (e.clientX - elements.seekbar.offset().left) / elements.seekbar.width();
                elements.video[0].currentTime = elements.video[0].duration * ratio;
                break;
            case 'mouseenter':
                elements.seekbar_cursor.show();
                break;
            case 'mouseleave':
                elements.seekbar_cursor.hide();
                break;
            case 'mousemove':
                elements.seekbar_cursor.css({
                    left : e.offsetX
                });
                break;
        }
    });

    /*
     * Container
     */
    var controls_timeout  = null;

    elements.container.on('mouseenter mouseleave mousemove',function(e)
    {
        switch(e.type)
        {
            case 'mousemove':

                elements.controls.show();

                if(controls_timeout)
                    window.clearTimeout(controls_timeout);

                controls_timeout = window.setTimeout(function()
                {
                    if(!elements.video[0].paused)
                        elements.controls.hide();
                },2000);

                break;
            case 'mouseenter':

                elements.controls.stop(true,true).show();
                
                break;
            case 'mouseleave':

                if(controls_timeout)
                    window.clearTimeout(controls_timeout);

                if(!elements.video[0].paused)
                    elements.controls.stop(true,true).hide();

                break;
        }
    });


    /*
     * Fullscreen
     */
    var fullscreen = false;
    elements.fullscreen.on('click',function()
    {
        if(!fullscreen)
        {
            if(elements.container[0].requestFullScreen)
                elements.container[0].requestFullScreen();
            else if(elements.container[0].mozRequestFullScreen)
                elements.container[0].mozRequestFullScreen();
            else if(elements.container[0].webkitRequestFullScreen)
                elements.container[0].webkitRequestFullScreen();
        }
        else
        {
            if(document.cancelFullScreen)
                document.cancelFullScreen();
            else if(document.mozCancelFullScreen)
                document.mozCancelFullScreen();
            else if(document.webkitCancelFullScreen)
                document.webkitCancelFullScreen();
        }
        fullscreen = !fullscreen;
    });

    $(document).on('webkitfullscreenchange mozfullscreenchange fullscreenchange',function(e)
    {
        switch(e.type)
        {
            case 'webkitfullscreenchange':
                fullscreen = document.webkitIsFullScreen;
                break;
            case 'mozfullscreenchange':
                fullscreen = document.mozFullScreen;
                break;
            case 'fullscreenchange':
                fullscreen = document.fullScreen;
                break;
        }
        
        if(fullscreen)
        {
            elements.container.css({
                'min-width'  : '100%',
                'min-height' : '100%'
            });
        }
        else
        {
            elements.container.css({
                'min-width'  : '0',
                'min-height' : '0'
            });
        }
    });
}

/*
 * Set elements
 */
function set_custom_elements(elements)
{
    elements.container.css({
        width  : elements.video.width(),
        height : elements.video.height()
    });

    elements.video[0].volume = 0.4;
    elements.volume_current.css({
        height: elements.video[0].volume * 100
    });

    elements.video.attr('width','100%');
    elements.video.attr('height','100%');
    elements.video.removeAttr('controls');
    elements.video.addClass('customized');
}

/*
 * Create controls and container
 */
function create_custom_elements(video)
{
    //Creating all elements first
    var container        = $('<div class="container custom-video"></div>'),
        controls         = $('<div class="controls" />'),
        play             = $('<div class="play-pause play icon-play" />'),
        seekbar          = $('<div class="seekbar" />'),
        seekbar_played   = $('<div class="seekbar-played" />'),
        seekbar_buffured = $('<div class="seekbar-buffured" />'),
        seekbar_cursor   = $('<div class="seekbar-cursor" />'),
        volume           = $('<div class="volume" />'),
        volume_btn       = $('<div class="volume-btn icon-volume-up" />'),
        volume_bar       = $('<div class="volume-bar" />'),
        volume_current   = $('<div class="volume-current" />'),
        volume_cursor    = $('<div class="volume-cursor" />'),
        fullscreen       = $('<div class="fullscreen icon-resize-full-alt" />');

    //Container
    container = video.wrap(container).parent();

    //Seekbar
    seekbar.append(seekbar_buffured);
    seekbar.append(seekbar_played);
    seekbar.append(seekbar_cursor);
    controls.append(seekbar);

    //Volume
    volume_bar.append(volume_current);
    volume_bar.append(volume_cursor);
    volume.append(volume_bar);
    volume.append(volume_btn);
    controls.append(volume);

    //Play
    controls.append(play);

    //Fullscreen
    controls.append(fullscreen);

    //Controls
    container.append(controls);

    //Returning elements in an object
    return {
        video            : video,
        container        : container,
        controls         : controls,
        play             : play,
        seekbar          : seekbar,
        seekbar_played   : seekbar_played,
        seekbar_buffured : seekbar_buffured,
        seekbar_cursor   : seekbar_cursor,
        volume           : volume,
        volume_btn       : volume_btn,
        volume_bar       : volume_bar,
        volume_current   : volume_current,
        volume_cursor    : volume_cursor,
        fullscreen       : fullscreen
    };
}