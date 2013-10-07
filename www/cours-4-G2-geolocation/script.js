$(function()
{
    if(navigator.geolocation)
    {
        var map    = new google.maps.Map(document.getElementById('map'),{zoom:17,mapTypeId:google.maps.MapTypeId.ROADMAP}),
            center = null,
            marker = null,
            circle = null;

        navigator.geolocation.watchPosition(
            function(position)
            {
                console.log(position);

                $('#lat').html(position.coords.latitude);
                $('#lon').html(position.coords.longitude);
                $('#accuracy').html(position.coords.accuracy);

                //Center
                center = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

                //Marker
                if(marker === null)
                    marker = new google.maps.Marker({position:center,map:map});
                else
                    marker.setPosition(center);

                //Radius
                if(circle === null)
                    circle = new google.maps.Circle({map:map,fillColor:'#00c7ff',strokeWeight:0});
                circle.bindTo('center',marker,'position');
                circle.setRadius(position.coords.accuracy);


                //Set map center
                map.setCenter(center,17);
            },
            function(error)
            {
                console.log(error.message);
            }
        );
    }
    else
    {
        alert('Geolocation is not supported');
    }
});