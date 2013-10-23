window.onload = function()
{
    var canvas  = document.getElementById('canvas'),
        context = canvas.getContext('2d');

    var gradient = context.createLinearGradient(50,50,250,250);
    gradient.addColorStop(0,'red');
    gradient.addColorStop(1,'white');
    context.fillStyle = gradient;
    context.fillRect(0,0,600,600);

    context.beginPath();
    context.moveTo(50,50);
    context.lineTo(250,250);
    context.lineTo(50,250);
    context.fillStyle     = 'red';
    context.fill();

    context.beginPath();
    context.fillStyle     = 'blue';
    context.arc(100,340,50,Math.PI*2,false);
    context.fill();

    var text             = 'Lorem ipsum dolor sit amet';
    context.fillStyle    = 'black';
    context.font         = '40px Arial';
    context.textAlign    = 'right';
    context.textBaseline = 'middle';
    console.log(context.measureText(text));
    context.fillText(text,400,200);

    var monimage = new Image();
    monimage.onload = function()
    {
        console.log(monimage.width);
        console.log(monimage.height);
        context.drawImage(monimage,0,0,monimage.width/10,monimage.height/10);
    };
    monimage.src = 'image-1.jpg';

    // context.lineWidth   = 20;
    // context.lineCap     = 'round';
    // context.lineJoin    = 'mitter';
    // context.strokeStyle = 'rgba(255,0,0,0.5)';

    // context.fillStyle     = 'rgba(255,0,0,1)';
    // context.shadowColor   = 'black';
    // context.shadowOffsetX = 10;
    // context.shadowOffsetY = 20;
    // context.shadowBlur    = 10;

    // context.fillRect(50,50,200,100);
    // context.clearRect(50,50,50,50);
};