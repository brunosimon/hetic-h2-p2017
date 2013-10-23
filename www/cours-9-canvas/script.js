window.onload = function()
{
    var canvas  = document.getElementById('canvas'),
        context = canvas.getContext('2d');

    /* Lignes */
    context.beginPath();      // Commencer un tracé
    context.moveTo(50,50);    // Placer le tracé
    context.lineTo(200,200);  // Tracer une ligne (théorique)
    context.lineTo(50,200);   // Tracer autre une ligne (théorique)
    context.closePath();      // Tracer une dernière ligne qui ferme la forme (non obligatoire)
    context.stroke();         // Faire apparaitre les lignes tracées

    /* Remplissage */
    // context.beginPath();      // Commencer un tracé
    // context.moveTo(50,50);    // Placer le tracé
    // context.lineTo(200,200);  // Tracer une ligne (théorique)
    // context.lineTo(50,200);   // Tracer autre une ligne (théorique)
    // context.fill();           // Faire apparaitre la forme dessinée

    /* Style de ligne */
    // context.beginPath();
    // context.moveTo(50,50);
    // context.lineTo(200,200);
    // context.lineTo(50,200);
    // context.lineWidth   = 20;       // Largeur de la ligne
    // context.lineCap     = 'round';  // Fin de ligne (round | butt | square)
    // context.lineJoin    = 'bevel';  // Jointure des lignes (bevel | round | mitter)
    // context.strokeStyle = 'orange'; // Couleur de la ligne
    // context.stroke();

    /* Style de remplissage */
    // context.beginPath();
    // context.moveTo(50,50);
    // context.lineTo(200,200);
    // context.lineTo(50,200);
    // context.fillStyle = 'rgba(255,0,0,0.5)'; // Couleur du remplissage
    // context.fill();

    /* Ombres */
    // context.beginPath();
    // context.moveTo(50,50);
    // context.lineTo(200,200);
    // context.lineTo(50,200);
    // context.fillStyle     = 'rgba(255,0,0,1)';
    // context.shadowColor   = 'blue';   // Couleur de l'ombre
    // context.shadowBlur    = 50;       // Largeur du flou
    // context.shadowOffsetX = 5;        // Décalage en X
    // context.shadowOffsetY = 10;       // Décalage en Y
    // context.fill();

    /* Remplissage par forme */
    // context.beginPath();
    // context.fillStyle = 'orange';
    // context.fillRect(50,50,300,160);           //Tracer un rectangle (sans appel de la fonction fill)
    // context.clearRect(50,50,100,80);           //Effacer un rectangle (sans appel de la fonction fill)
    // context.fillStyle = 'red';
    // context.arc(280,210,50,0,Math.PI,false);   //Tracer un arc de cercle (theorique) x,y,r,rad1,rad2,s
    // context.arc(120,210,50,0,Math.PI,false);   //Tracer un autre arc de cercle (theorique)
    // context.fill();                            //Faire apparaitre les formes tracées
    // context.beginPath();                       //Recommencer un tracé
    // context.fillStyle = 'skyblue';
    // context.rect(160,60,20,70);
    // context.fill();                            //Faire apparaitre les formes tracées

    /* Écrire du texte */
    // var text = 'Lorem ipsum dolor sit amet';
    // console.log(context.measureText(text).width); // Affiche la largeur du texte dans la console (sans le dessiner)
    // context.font         = '40px Arial';          // Font
    // context.textAlign    = 'center';              // Alignement horizontal (left | center | right)
    // context.textBaseline = 'top';                 // Alignement vertical (top | bottom | middle | alphabetic | hanging)
    // context.fillText(text,400,100);               // Faire apparaitre le texte
    // context.strokeText(text,400,160);             // Faire apparaitre le contour du texte

    /* Image */
    // /* L'image doit être créée en javascript il faut écouter l'événement load avant de l'utiliser */
    // var image = new Image();
    // image.onload = function()
    // {
    //     context.drawImage(image,0,0,image.width / 6,image.height / 6);
    //     //drawImage permet aussi de dessiner un autre canvas ou de la vidéo
    // };
    // image.src = 'image-1.jpg';

    /* Dégradé linéaire */
    // var gradient = context.createLinearGradient(50,50,250,250); // x,y,width,height
    // gradient.addColorStop(0,  'rgb(255,80,0)');    // Départ
    // gradient.addColorStop(0.5,'rgb(255,191,0)');   // Milieu
    // gradient.addColorStop(1,  'rgb(255,246,155)'); // Arrivée
    // context.fillStyle = gradient;                  // Le gradient devient le style de remplissage
    // context.fillRect(0,0,400,400);                 // Faire apparaître

    /* Dégradé radial */
    // var gradient = context.createRadialGradient(0,0,50,0,250,350); // cx1, cy1, cr1, cx2, cy2, cr2
    // gradient.addColorStop(0,  'rgb(255,80,0)');    // Départ
    // gradient.addColorStop(0.5,'rgb(255,191,0)');   // Milieu
    // gradient.addColorStop(1,  'rgb(255,246,155)'); // Arrivée
    // context.fillStyle = gradient;                  // Le gradient devient le style de remplissage
    // context.fillRect(0,0,400,400);                 // Faire apparaître

    /* Save() et Restore() */
    // context.beginPath();
    // context.moveTo(50,50);
    // context.lineTo(300,50);
    // context.save();              // Sauvegarde les propriétés du context
    // context.lineWidth = 20;      // Changement d'une des propriétés
    // context.stroke();            // Dessin du trait
    // context.beginPath();
    // context.moveTo(50,100);
    // context.lineTo(300,100);
    // context.save();              // Nouvelle sauvegarde des propriétés du context
    // context.strokeStyle = 'red'; // Changement d'une autre propriété
    // context.stroke();            // Dessin du trait
    // context.beginPath();
    // context.moveTo(50,150);
    // context.lineTo(300,150);
    // context.restore();           // Restauration des propriétés à la derniène sauvegarde
    // context.restore();           // Restauration des propriétés à la sauvegarde encore avant
    // context.stroke();            // Dessin du trait

    /* Courbe de Bézier */
    // context.beginPath();
    // context.moveTo(50,50);
    // context.bezierCurveTo(300,100,100,300,300,300);
    // context.stroke();

    /* Courbe quadratique (de bézier) */
    // context.beginPath();
    // context.moveTo(50,50);
    // context.quadraticCurveTo(300,100,300,300);
    // context.stroke();

    /* globalAlpha */
    // context.globalAlpha = 0.2; /* Réduction de l'opacité */
    // context.fillStyle = 'red';
    // context.fillRect(50,50,200,200);
    // context.fillStyle = 'orange';
    // context.fillRect(100,100,200,200);
    // context.fillStyle = 'green';
    // context.fillRect(150,150,200,200);

    /* globalCompositeOperation */
    // context.fillStyle = 'red';
    // context.fillRect(200,200,200,200);
    // context.globalCompositeOperation = 'destination-out'; /* source-over | source-in | source-out | source-atop | destination-over | destination-in | destination-out | desination-atop | lighter | copy | xor */
    // context.beginPath();
    // context.fillStyle = 'blue';
    // context.arc(200,250,100,0,Math.PI,false);
    // context.fill();

    /* getImageData */
    /* Si vous utilisez une image dans le canvas, lancez MAMP/WAMP pour éviter les proplème de cross-domain */
    // var image = new Image();
    // image.onload = function()
    // {
    //     /* Dessiner l'image chargée dans le canvas */
    //     context.drawImage(image,0,0,image.width / 6,image.height / 6);

    //     /* Récupérer les pixels dans image_data */
    //     var image_data = context.getImageData(0,0,image.width / 6,image.height / 6);

    //     /* parcourir les pixels 4 par 4 */
    //     for(var i = 0; i < image_data.data.length; i += 4)
    //     {
    //         /* Traiter ces pixels couleur par couleur */
    //         /* Ici on rend l'image noir et blanc */
    //         var b = 0.4 * image_data.data[i] + 0.4 * image_data.data[i + 1] + 0.4 * image_data.data[i + 2];
    //         image_data.data[i]     = b;
    //         image_data.data[i + 1] = b;
    //         image_data.data[i + 2] = b;
    //         // image_data.data[i + 3] = 1; /* On ne touche pas à l'apha */
    //     }

    //     /* Dessiner la nouvelle image par dessus l'ancienne */
    //     context.putImageData(image_data,0,0);
    // };
    // image.src = 'image-1.jpg';
};