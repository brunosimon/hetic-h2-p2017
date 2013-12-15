window.onload = function()
{
    if(navigator.geolocation)
    {
        // getCurrentPosition
        // Basics
        // Works one time at start
        /*
        navigator.geolocation.getCurrentPosition(
            function(position)
            {
                console.log(position);
                $('#lat').html(position.coords.latitude);
                $('#lon').html(position.coords.longitude);
                $('#accuracy').html(position.coords.accuracy + 'm');
            },
            function(error)
            {
                console.log(error);
                switch (error.code)
                {
                    case 1:
                        alert('You must authorized geolocation');
                        break;
                    case 2:
                        alert('Can\'t find your location');
                        break;
                    case 3:
                        alert('It tooks too long');
                        break;
                }
            }
        );
        */


        // getCurrentPosition
        // With interval and distance from start
        // Try to get position every seconds
        /*
        var start    = null,
            distance = null;

        window.setInterval(function()
        {
            navigator.geolocation.getCurrentPosition(
                function(position)
                {
                    console.log(position);

                    if(start === null)
                        start = position.coords;

                    $('#lat').html(position.coords.latitude.toFixed(6));
                    $('#lon').html(position.coords.longitude.toFixed(6));
                    $('#accuracy').html(position.coords.accuracy + 'm');

                    distance = get_distance(start.latitude,start.longitude,position.coords.latitude,position.coords.longitude);
                    $('#distance').html(distance.toFixed(2) + ' m');
                }
            );
        },1000);
        */

        // watchPosition
        // Basics
        // get position when the divice say it changed
        // Use GPS if avaible
        navigator.geolocation.watchPosition(
            function(position)
            {
                console.log(position);

                $('#lat').html(position.coords.latitude);
                $('#lon').html(position.coords.longitude);
                $('#accuracy').html(position.coords.accuracy + 'm');
            }
        );

        // watchPosition
        // With google map
        var map    = new google.maps.Map(document.getElementById('map'),{zoom:17,mapTypeId:google.maps.MapTypeId.ROADMAP}),
            center = null,
            marker = null,
            circle = null,
            watch  = null;

        watch = navigator.geolocation.watchPosition(
            function(position)
            {
                console.log(position);

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
            }
        );
    }
    else
    {
        alert('Geolocation is not supported');
    }
};

function get_distance(lat_1,lon_1,lat_2,lon_2)
{
    var radius = 6378.137,
        d_lat  = (lat_2 - lat_1) * Math.PI / 180,
        d_lon  = (lon_2 - lon_1) * Math.PI / 180,
        a      = Math.sin(d_lat/2) * Math.sin(d_lat/2) +
                 Math.cos(lat_1 * Math.PI / 180) * Math.cos(lat_2 * Math.PI / 180) *
                 Math.sin(d_lon/2) * Math.sin(d_lon/2),
        c      = 2 * Math.atan2(Math.sqrt(a),Math.sqrt(1-a)),
        d      = radius * c;

    return d * 1000; //Meters
}