window.onload = function()
{
    var inner = document.getElementById('inner');

    window.onmousemove = function(e)
    {
        inner.style.webkitTransform = 'rotateY('+e.x+'deg) rotateX('+e.y+'deg)';
    };
};