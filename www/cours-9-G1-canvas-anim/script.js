var canvas     = null,
    context    = null,
    coords     = null,
    particules = null,
    count      = 5;

window.onload = function()
{
    canvas  = document.getElementById('canvas');
    context = canvas.getContext('2d');
    coords  = {
        x : 0,
        y : 0
    };
    particules = Array();

    window.onmousemove = function(e)
    {
        coords  = {
            x : e.clientX,
            y : e.clientY
        };
    };

    requestAnimFrame(loop);

    var gui = new dat.GUI();
    gui.add(window,'count',1,10).step(1);
};

function loop()
{
    requestAnimFrame(loop);
    update();
    create();
    draw();
}

function draw()
{
    var particule = null;

    context.clearRect(0,0,canvas.width,canvas.height);

    for(var i = 0; i < particules.length; i++)
    {
        particule = particules[i];

        context.beginPath();
        context.fillStyle = particule.c;
        context.arc(particule.x,particule.y,particule.r,0,Math.PI*2);
        context.fill();
    }
}

function create()
{
    if(particules.length < 10000)
    {
        for(var i = 0; i < count; i ++)
        {
            var particule = {
                x       : coords.x,
                y       : coords.y,
                r       : Math.random() * 10,
                c       : 'hsl('+Math.random() * 360+',100%,50%)',
                speed_x : Math.random() * 4 - 2,
                speed_y : Math.random() * 4 - 2
            };
            particules.push(particule);
        }
    }
}

function update()
{
    var particule = null;

    for(var i = 0; i < particules.length; i++)
    {
        particule = particules[i];
        particule.x += particule.speed_x;
        particule.y += particule.speed_y;

        if(check_position(particule.x,particule.y,particule.r))
        {
            particules.splice(i,1);
            i--;
        }
    }
}

function check_position(x,y,r)
{
    return (x + r < 0 || y + r < 0 || x - r > canvas.width || y - r > canvas.height);
}





/* Compatible avec tous les navigateurs */
window.requestAnimFrame = (function()
{
    return  window.requestAnimationFrame       ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            function(callback)
            {
                window.setTimeout(callback, 1000 / 60);
            };
})();
