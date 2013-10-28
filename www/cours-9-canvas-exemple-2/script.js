//Create variable out of any function
var canvas,
    context,
    particules,
    iterations,
    mouse;

/*
 * Init canvas, context and events
 */
function init()
{
    canvas     = document.getElementById('canvas'),
    context    = canvas.getContext('2d'),
    particules = Array(),
    iterations = 0,
    mouse      = {
        x : 100,
        y : 100
    };

    canvas.width  = window.innerWidth;
    canvas.height = window.innerHeight;

    canvas.onmousemove = function(e)
    {
        mouse.x = e.offsetX;
        mouse.y = e.offsetY;
    };

    loop();
}

/*
 * Loop function call each frame
 */
function loop()
{
    requestAnimFrame(loop);
    iterations++;
    try_to_create_particule();
    move_particules();
    draw();
}

/*
 * Create particle if authorized
 */
function try_to_create_particule()
{
    if(iterations % 1 === 0 && particules.length < 1000)
    {
        var random = Math.random();
        particules.push({
            x       : mouse.x,
            y       : mouse.y,
            speed_x : Math.sin(random * Math.PI*2)*4 * Math.random(),
            speed_y : Math.cos(random * Math.PI*2)*4 * Math.random(),
            radius  : Math.random() * 20 + 2,
            hue     : Math.random() * 360
        });
    }
}

/*
 * Update each particle position
 */
function move_particules()
{
    for(var i = 0; i < particules.length; i++)
    {
        particule = particules[i];
        particule.x += particule.speed_x;
        particule.y += particule.speed_y;

        if(
            particule.x + particule.radius < 0            ||
            particule.x - particule.radius > canvas.width ||
            particule.y + particule.radius < 0            ||
            particule.y - particule.radius > canvas.height
        )
        {
            particules.splice(i,1);
            i--;
        }
    }
}

/*
 * Clear canvas and draw particules
 */
function draw()
{
    context.clearRect(0,0,canvas.width,canvas.height);
    var particule = null;

    for(var i = 0; i < particules.length; i++)
    {
        particule = particules[i];
        context.beginPath();
        context.fillStyle = 'hsl('+particule.hue+',50%,50%)';
        context.arc(particule.x,particule.y,particule.radius,0,Math.PI * 2);
        context.globalCompositeOperation = 'lighten';
        context.fill();
    }
}

/*
 * Request animation frame
 */
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

window.onload = init();