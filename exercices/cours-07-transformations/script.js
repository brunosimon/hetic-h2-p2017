window.onload = function()
{
    var cube  = document.getElementById('cube'),
        inner = document.getElementById('inner');

    window.onmousemove = function(e)
    {
        inner.style.webkitTransform = 'rotateX('+(-e.y)+'deg) rotateY('+e.x+'deg)';
        inner.style.mozTransform = 'rotateX('+(-e.y)+'deg) rotateY('+e.x+'deg)';
        inner.style.transform = 'rotateX('+(-e.y)+'deg) rotateY('+e.x+'deg)';
    };
};