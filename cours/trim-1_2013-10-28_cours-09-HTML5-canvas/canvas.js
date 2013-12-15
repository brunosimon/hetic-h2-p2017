window.onload = function()
{
    var canvas   = null,
        context  = null,
        contexts = Array();

    for(var i = 1; i < 19; i++)
    {
        canvas = document.getElementById('canvas-'+i);
        if(canvas)
        {
            context = canvas.getContext('2d');
            contexts.push(context);
        }
    }

    /* Lignes */
    contexts[0].beginPath();      // Commencer un tracé
    contexts[0].moveTo(50,50);    // Placer le tracé
    contexts[0].lineTo(200,200);  // Tracer une ligne (théorique)
    contexts[0].lineTo(50,200);   // Tracer autre une ligne (théorique)
    contexts[0].closePath();      // Tracer une dernière ligne qui ferme la forme (non obligatoire)
    contexts[0].stroke();         // Faire apparaitre les lignes tracées

    /* Remplissage */
    contexts[1].beginPath();      // Commencer un tracé
    contexts[1].moveTo(50,50);    // Placer le tracé
    contexts[1].lineTo(200,200);  // Tracer une ligne (théorique)
    contexts[1].lineTo(50,200);   // Tracer autre une ligne (théorique)
    contexts[1].fill();           // Faire apparaitre la forme dessinée

    /* Style de ligne */
    contexts[2].beginPath();
    contexts[2].moveTo(50,50);
    contexts[2].lineTo(200,200);
    contexts[2].lineTo(50,200);
    contexts[2].lineWidth   = 20;       // Largeur de la ligne
    contexts[2].lineCap     = 'round';  // Fin de ligne (round | butt | square)
    contexts[2].lineJoin    = 'bevel';  // Jointure des lignes (bevel | round | mitter)
    contexts[2].strokeStyle = 'orange'; // Couleur de la ligne
    contexts[2].stroke();

    /* Style de remplissage */
    contexts[3].beginPath();
    contexts[3].moveTo(50,50);
    contexts[3].lineTo(200,200);
    contexts[3].lineTo(50,200);
    contexts[3].fillStyle = 'rgba(255,0,0,0.5)'; // Couleur du remplissage
    contexts[3].fill();

    /* Ombres */
    contexts[4].beginPath();
    contexts[4].moveTo(50,50);
    contexts[4].lineTo(200,200);
    contexts[4].lineTo(50,200);
    contexts[4].fillStyle     = 'rgba(255,0,0,1)';
    contexts[4].shadowColor   = 'blue';   // Couleur de l'ombre
    contexts[4].shadowBlur    = 50;       // Largeur du flou
    contexts[4].shadowOffsetX = 5;        // Décalage en X
    contexts[4].shadowOffsetY = 10;       // Décalage en Y
    contexts[4].fill();

    /* Remplissage par forme */
    contexts[5].beginPath();
    contexts[5].fillStyle = 'orange';
    contexts[5].fillRect(50,50,300,160);           //Tracer un rectangle (sans appel de la fonction fill)
    contexts[5].clearRect(50,50,100,80);           //Effacer un rectangle (sans appel de la fonction fill)
    contexts[5].fillStyle = 'red';
    contexts[5].arc(280,210,50,0,Math.PI,false);   //Tracer un arc de cercle (theorique) x,y,r,rad1,rad2,s
    contexts[5].arc(120,210,50,0,Math.PI,false);   //Tracer un autre arc de cercle (theorique)
    contexts[5].fill();                            //Faire apparaitre les formes tracées
    contexts[5].beginPath();                       //Recommencer un tracé
    contexts[5].fillStyle = 'skyblue';
    contexts[5].rect(160,60,20,70);
    contexts[5].fill();                            //Faire apparaitre les formes tracées

    /* Écrire du texte */
    var text = 'Lorem ipsum dolor sit amet';
    contexts[6].font         = '40px Arial';          // Font
    contexts[6].textAlign    = 'center';              // Alignement horizontal (left | center | right)
    contexts[6].textBaseline = 'top';                 // Alignement vertical (top | bottom | middle | alphabetic | hanging)
    contexts[6].fillText(text,400,100);               // Faire apparaitre le texte
    contexts[6].strokeText(text,400,160);             // Faire apparaitre le contour du texte

    /* Image */
    /* L'image doit être créée en javascript il faut écouter l'événement load avant de l'utiliser */
    var image = new Image();
    image.onload = function()
    {
        contexts[7].drawImage(image,0,0,image.width / 6,image.height / 6);
        //drawImage permet aussi de dessiner un autre canvas ou de la vidéo
    };
    image.src = 'image-1.jpg';

    /* Dégradé linéaire */
    var gradient = contexts[8].createLinearGradient(50,50,250,250); // x,y,width,height
    gradient.addColorStop(0,  'rgb(255,80,0)');    // Départ
    gradient.addColorStop(0.5,'rgb(255,191,0)');   // Milieu
    gradient.addColorStop(1,  'rgb(255,246,155)'); // Arrivée
    contexts[8].fillStyle = gradient;                  // Le gradient devient le style de remplissage
    contexts[8].fillRect(0,0,400,400);                 // Faire apparaître

    /* Dégradé radial */
    gradient = contexts[9].createRadialGradient(0,0,50,0,250,350); // cx1, cy1, cr1, cx2, cy2, cr2
    gradient.addColorStop(0,  'rgb(255,80,0)');    // Départ
    gradient.addColorStop(0.5,'rgb(255,191,0)');   // Milieu
    gradient.addColorStop(1,  'rgb(255,246,155)'); // Arrivée
    contexts[9].fillStyle = gradient;                  // Le gradient devient le style de remplissage
    contexts[9].fillRect(0,0,400,400);                 // Faire apparaître

    /* Save() et Restore() */
    contexts[10].beginPath();
    contexts[10].moveTo(50,50);
    contexts[10].lineTo(300,50);
    contexts[10].save();              // Sauvegarde les propriétés du context
    contexts[10].lineWidth = 20;      // Changement d'une des propriétés
    contexts[10].stroke();            // Dessin du trait
    contexts[10].beginPath();
    contexts[10].moveTo(50,100);
    contexts[10].lineTo(300,100);
    contexts[10].save();              // Nouvelle sauvegarde des propriétés du context
    contexts[10].strokeStyle = 'red'; // Changement d'une autre propriété
    contexts[10].stroke();            // Dessin du trait
    contexts[10].beginPath();
    contexts[10].moveTo(50,150);
    contexts[10].lineTo(300,150);
    contexts[10].restore();           // Restauration des propriétés à la derniène sauvegarde
    contexts[10].restore();           // Restauration des propriétés à la sauvegarde encore avant
    contexts[10].stroke();            // Dessin du trait

    /* Courbe de Bézier */
    contexts[11].beginPath();
    contexts[11].moveTo(50,50);
    contexts[11].bezierCurveTo(300,100,100,300,300,300);
    contexts[11].stroke();

    /* Courbe quadratique (de bézier) */
    contexts[12].beginPath();
    contexts[12].moveTo(50,50);
    contexts[12].quadraticCurveTo(300,100,300,300);
    contexts[12].stroke();

    /* globalAlpha */
    contexts[13].globalAlpha = 0.2; /* Réduction de l'opacité */
    contexts[13].fillStyle = 'red';
    contexts[13].fillRect(50,50,200,200);
    contexts[13].fillStyle = 'orange';
    contexts[13].fillRect(100,100,200,200);
    contexts[13].fillStyle = 'green';
    contexts[13].fillRect(150,150,200,200);

    /* globalCompositeOperation */
    contexts[14].fillStyle = 'red';
    contexts[14].fillRect(200,150,200,200);
    contexts[14].globalCompositeOperation = 'destination-out'; /* source-over | source-in | source-out | source-atop | destination-over | destination-in | destination-out | desination-atop | lighter | copy | xor */
    contexts[14].beginPath();
    contexts[14].fillStyle = 'blue';
    contexts[14].arc(200,200,100,0,Math.PI,false);
    contexts[14].fill();

    /* getImageData */
    image = new Image();
    image.onload = function()
    {
        /* Dessiner l'image chargée dans le canvas */
        contexts[15].drawImage(image,0,0,image.width / 6,image.height / 6);

        /* Récupérer les pixels dans image_data */
        var image_data = contexts[15].getImageData(0,0,image.width / 6,image.height / 6);

        /* parcourir les pixels 4 par 4 */
        for(var i = 0; i < image_data.data.length; i += 4)
        {
            /* Traiter ces pixels couleur par couleur */
            /* Ici on rend l'image noir et blanc */
            var b = 0.4 * image_data.data[i] + 0.4 * image_data.data[i + 1] + 0.4 * image_data.data[i + 2];
            image_data.data[i]     = b;
            image_data.data[i + 1] = b;
            image_data.data[i + 2] = b;
            // image_data.data[i + 3] = 1; /* On ne touche pas à l'apha */
        }

        /* Dessiner la nouvelle image par dessus l'ancienne */
        contexts[15].putImageData(image_data,0,0);
    };
    image.src = 'image-1.jpg';

    /* Exemple d'animation */
    var coords = {x:0,y:200};
    function loop()
    {
        requestAnimFrame(loop); //Avant d'effectuer d'autre action
        
        //Mettre à jour la position
        coords.x += 4;
        if(coords.x > 650)
            coords.x = -50;
        
        //Redessiner le canvas
        contexts[16].clearRect(0,0,600,400);
        contexts[16].beginPath();
        contexts[16].arc(coords.x,coords.y,50,0,Math.PI*2);
        contexts[16].fillStyle = 'orange';
        contexts[16].fill();
    }
    loop();
};

/* Paul Irish Request Animation Frame */
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

