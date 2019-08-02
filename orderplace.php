<?php
$key = '99';

$keyget = $_GET['key'];
$idgetlat = $_GET['lat'];
$idgetlng = $_GET['lng'];
$idgetlatres = $_GET['reslat'];
$idgetlngres = $_GET['reslng'];

   if($keyget == '' || $keyget == null){
       echo 'method not allowed 405';
       die();
   }

   if($idgetlat == '' || $idgetlat == null){
    echo 'method not allowed 405';
    die();
   }

   if($idgetlng == '' || $idgetlng == null){
    echo 'method not allowed 405';
    die();
   }

   if($idgetlatres == '' || $idgetlatres == null){
    echo 'method not allowed 405';
    die();
   }

   if($idgetlngres == '' || $idgetlngres == null){
    echo 'method not allowed 405';
    die();
   }

   if($key != $keyget){
    echo 'method not allowed 405';
    die();
   }
?>




<!DOCTYPE html>
<html>
  <head>

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <meta charset="utf-8">
  
    <style>

      #map {
        height: 100%;
      }
      
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      .gm-style .gm-style-iw{
        margin-top: -5px;
      }

      .gm-style .gm-style-iw-t::after {
        margin-top: -5px;
      }

      .distrance{
        color: red;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
   
    <script>
  

  


      var map, infoWindow;
      var lat = '<?php echo $idgetlat ?>';
      var lng = '<?php echo $idgetlng ?>';
      var latshop = '<?php echo $idgetlatres ?>';
      var lngshop = '<?php echo $idgetlngres ?>';
      var marker;
      var marker1;
      

      
      

      
function initMap() {

       
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var geocoder = new google.maps.Geocoder;
    var myLatlng = new google.maps.LatLng(lat,lng);
    var ShopLatlng = new google.maps.LatLng(latshop,lngshop);
    var mapOptions = {
    zoom:10,
    center: myLatlng
    }
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    directionsDisplay.setMap(map);

   
//location 
   
   
    var latlng1 = {
        lat:parseFloat(lat),
        lng:parseFloat(lng)
    };
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
                           
                            map.setZoom(14);
                            map.setCenter(marker.getPosition());
                            

            });
            
          
          
        },1 * 200);


    });
    


       
   //location shop




   var latlng2 = {
        lat:parseFloat(latshop),
        lng:parseFloat(lngshop)
    };
    geocoder.geocode({
        'location': latlng2
    }, function (results,status) {



        window.setTimeout(function() {


            
            var infowindow;
    
            var html =  '<div>'+results[0]['formatted_address']+'</div>';
           
            infowindow = new google.maps.InfoWindow({
            content: html
            });


            marker1 = new google.maps.Marker({
              position: ShopLatlng,
              map: map,
              animation: google.maps.Animation.DROP,
              
            });

            

            infowindow.open(map,marker1);

            window.setTimeout(function() {
              map.panTo(marker1.getPosition());
            }, 3000);
          

            google.maps.event.addListener(marker1, 'click', function(){
                           
                            map.setZoom(14);
                            map.setCenter(marker1.getPosition());
                            

            });
            
          
        },1 * 200);


    });


    setTimeout(function(){

  




calculateAndDisplayRoute(directionsService,directionsDisplay,lat,lng,latshop,lngshop);

function calculateAndDisplayRoute(directionsService, directionsDisplay,lat,lng,latshop,lngshop) {
    directionsService.route({
      origin:{lat:parseFloat(lat), lng: parseFloat(lng)},
      destination:{lat:parseFloat(latshop), lng:parseFloat(lngshop)},
      travelMode: google.maps.DirectionsTravelMode.DRIVING
    }, function(response, status) {
      if (status === 'OK') {
        marker1.setVisible(false);
        marker.setVisible(false);
        directionsDisplay.setDirections(response);
    
    
      var step = 1;
      var infowindow2 = new google.maps.InfoWindow();
      infowindow2.setContent(response.routes[0].legs[0].distance.text + "<br>" + response.routes[0].legs[0].duration.text + " ");
      infowindow2.setPosition(response.routes[0].legs[0].steps[step].end_location);
      infowindow2.open(map);  
        
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
    
  }


},6000);

       
  
          
       


        


    
   


}   
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKSpo-16NwxmBwCupn2bw1rDT7uC3yh8M&callback=initMap&libraries=places">
    </script>
    
  </body>
</html>
