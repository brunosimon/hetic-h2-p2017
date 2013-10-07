$(function()
{
    if(navigator.geolocation)
    {
        var distance = 0;
        var start    = null;

        navigator.geolocation.watchPosition(
            function(position)
            {
                if(start === null)
                {
                    start = position.coords;
                }

                distance = get_distance(
                    start.latitude,
                    start.longitude,
                    position.coords.latitude,
                    position.coords.longitude
                );

                $('#lat').html(position.coords.latitude);
                $('#lon').html(position.coords.longitude);
                $('#accuracy').html(position.coords.accuracy);
                $('#distance').html(distance);
            },
            function(error)
            {
                console.log(error);
            }
        );
    }
    else
    {
        alert('Geolocation is not supported');
    }
});

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