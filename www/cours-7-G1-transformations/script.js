window.onload = function()
{
    var cube  = document.getElementById('cube'),
        inner = document.getElementById('inner');

    window.onmousemove = function(e)
    {
        inner.style.webkitTransform = 'rotateY('+e.x+'deg) rotateX('+e.y+'deg)';
        inner.style.mozTransform    = 'rotateY('+e.x+'deg) rotateX('+e.y+'deg)';
        inner.style.transform       = 'rotateY('+e.x+'deg) rotateX('+e.y+'deg)';
    };
};