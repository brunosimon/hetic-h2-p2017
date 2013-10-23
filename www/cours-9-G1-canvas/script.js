window.onload = function()
{
    var canvas  = document.getElementById('canvas'),
        context = canvas.getContext('2d');

    // context.moveTo(50,50);
    // context.lineTo(200,200);
    // context.lineTo(50,200);

    // context.lineWidth   = 20; //Largeur de ligne
    // context.lineCap     = 'round'; //Fin de ligne
    // context.lineJoin    = 'round';
    // context.strokeStyle = 'rgba(255,0,0,0.5)';

    // context.fillStyle   = 'red';

    // context.shadowColor   = 'blue';   // Couleur de l'ombre
    // context.shadowBlur    = 50;       // Largeur du flou
    // context.shadowOffsetX = 5;        // Décalage en X
    // context.shadowOffsetY = 10;       // Décalage en Y


    // context.fillRect(50,50,300,160);
    // context.clearRect(50,50,100,100);

    // context.beginPath();
    // context.arc(300,100,100,Math.PI*2,false);
    // context.stroke();

    // context.beginPath();
    // context.arc(300,300,100,Math.PI*2,false);
    // context.stroke();

    // context.beginPath();

    // context.fillStyle = 'orange';
    // context.fillRect(50,50,300,160);         //Tracer un rectangle (sans appel de la fonction fill)

    // context.clearRect(50,50,100,80);         //Effacer un rectangle (sans appel de la fonction fill)
    
    // context.fillStyle = 'red';
    // context.arc(300,240,50,Math.PI*2,false); //Tracer un arc de cercle (theorique)
    // context.arc(100,240,50,Math.PI*2,false); //Tracer un autre arc de cercle (theorique)
    // context.fill();                          //Faire apparaitre les formes tracées

    // context.beginPath();                     //Recommencer un tracé
    // context.fillStyle = 'skyblue';
    // context.rect(160,60,20,70);
    // context.fill();                          //Faire apparaitre les formes tracées
    

    // var text = 'Lorem ipsum dolor sit amet';
    // context.font         = '40px Arial';          //Font
    // context.textAlign    = 'center';              //Alignement horizontal (left | center | right)
    // context.textBaseline = 'top';                 //Alignement vertical (top | bottom | middle | alphabetic | hanging)
    // console.log(context.measureText(text).width); //Affiche la largeur du texte dans la console (sans le dessiner)
    // context.fillText(text,400,100);               //Faire apparaitre le texte
    // context.strokeText(text,400,160);             //Faire apparaitre le contour du texte

    // Il faut créer l'image et attendre qu'elle soit chargée
    // var image = new Image();
    // image.onload = function()
    // {
    //     context.drawImage(image,0,0,300,200);
    // };
    // image.src = 'image-1.jpg';

    // var gradient = context.createLinearGradient(50,50,250,250);
    // gradient.addColorStop(0,  'rgb(255,80,0)');    // Départ
    // gradient.addColorStop(0.5,'rgb(255,191,0)');   // Milieu
    // gradient.addColorStop(1,  'rgb(255,246,155)'); // Arrivée
    // context.fillStyle = gradient;                  // Le gradient devient le style de remplissage
    // context.fillRect(0,0,400,400);                 // Faire apparaître

    var gradient = context.createRadialGradient(0,0,50,0,250,350); // cx1, cy1, cr1, cx2, cy2, cr2
    gradient.addColorStop(0,  'rgb(255,80,0)');    // Départ
    gradient.addColorStop(0.5,'rgb(255,191,0)');   // Milieu
    gradient.addColorStop(1,  'rgb(255,246,155)'); // Arrivée
    context.fillStyle = gradient;                  // Le gradient devient le style de remplissage
    context.fillRect(0,0,400,400);                 // Faire apparaître
};





















