window.onload = function()
{
    var video              = document.getElementById('video');
    var button_play        = document.getElementById('play');
    var button_pause       = document.getElementById('pause');
    var button_volume_up   = document.getElementById('volume-up');
    var button_volume_down = document.getElementById('volume-down');
    var button_seek        = document.getElementById('seek');
    var button_seek_value  = document.getElementById('seek-value');
    var cursor             = document.getElementById('cursor');

    // video.addEventListener('play',function(e)
    // {
    //     console.log('play');
    // });

    // video.addEventListener('pause',function(e)
    // {
    //     console.log('pause');
    // });

    window.setInterval(function()
    {
        var value = (video.currentTime / video.duration) * 100;
        cursor.style.width = value+'%';
    },500);

    button_play.onclick = function()
    {
        video.play();
    };

    button_pause.onclick = function()
    {
        video.pause();
    };

    button_volume_up.onclick = function()
    {
        if(video.volume + 0.1 < 1)
            video.volume += 0.1;
    };

    button_volume_down.onclick = function()
    {
        if(video.volume - 0.1 > 0)
            video.volume -= 0.1;
    };

    button_seek.onclick = function()
    {
        video.currentTime = button_seek_value.value;
    };
};