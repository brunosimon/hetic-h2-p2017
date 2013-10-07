window.onload = function()
{
    var video       = document.getElementById('video');
    var play        = document.getElementById('play');
    var pause       = document.getElementById('pause');
    var volume_up   = document.getElementById('volume-up');
    var volume_down = document.getElementById('volume-down');
    var seek        = document.getElementById('seek');
    var seek_value  = document.getElementById('seek-value');
    var bar         = document.getElementById('bar');
    var cursor      = document.getElementById('cursor');

    window.setInterval(function()
    {
        var percent = (video.currentTime / video.duration) * 100;
        cursor.style.width = percent + '%';
    },50);

    bar.onclick = function(e)
    {
        console.log(bar.offsetWidth);
        var ratio         = e.offsetX / bar.offsetWidth;
        var current       = video.duration * ratio;
        video.currentTime = current;
    };

    seek.onclick = function()
    {
        video.currentTime = seek_value.value;
    };

    play.onclick = function()
    {
        video.play();
    };

    pause.onclick = function()
    {
        video.pause();
    };

    volume_up.onclick = function()
    {
        if(video.volume + 0.1 <= 1)
            video.volume += 0.1;
        else
            video.volume = 1;
    };

    volume_down.onclick = function()
    {
        if(video.volume - 0.1 >= 0)
            video.volume -= 0.1;
        else
            video.volume = 0;
    };


};