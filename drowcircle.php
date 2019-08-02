<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Circles</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      

      var Myloc = [];
      var map;

      function initMap() {
        
        
        var geocoder = new google.maps.Geocoder;
        
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            Myloc.push(pos)
        });

        setTimeout(function(){

                            map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 4,
                            center: Myloc[0]
                            });


                            var latlng1 = {
                                lat:Myloc[0]['lat'],
                                lng:Myloc[0]['lng']
                            };
                            var myLatlng = new google.maps.LatLng(Myloc[0]['lat'],Myloc[0]['lng']);
                            geocoder.geocode({
                                'location': latlng1
                            }, function (results,status) {



                                window.setTimeout(function() {


                                    
                                    var infowindow;
                            
                                    var html =  '<div>'+results[0]['formatted_address']+'</div>';
                                
                                    infowindow = new google.maps.InfoWindow({
                                    content: html
                                    });


                                    marker = new google.maps.Marker({
                                    position: myLatlng,
                                    map: map,
                                    animation: google.maps.Animation.DROP,
                                    
                                    });

                                    

                                    infowindow.open(map,marker);

                                    window.setTimeout(function() {
                                    map.panTo(marker.getPosition());
                                    }, 3000);
                                

                                    google.maps.event.addListener(marker, 'click', function(){
                                                
                                                    map.setZoom(20);
                                                    map.setCenter(marker.getPosition());
                                                    

                                    });
                                    
                                
                                
                                },1 * 200);


                            });





                            var cityCircle = new google.maps.Circle({
                                strokeColor: '#FF0000',
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                fillColor: '#FF0000',
                                fillOpacity: 0.35,
                                map: map,
                                center: Myloc[0],
                                radius: Math.sqrt(603502) * 100
                            });




        },400);


        
    

        
      
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKSpo-16NwxmBwCupn2bw1rDT7uC3yh8M&callback=initMap">
    </script>
  </body>
</html>