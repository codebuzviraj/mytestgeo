

<?php

$key = '99';

$keyget = $_GET['key'];
$idgetarr = $_GET['arr'];
$shoplat = $_GET['lat'];
$shoplng = $_GET['lng'];

   if($keyget == '' || $keyget == null){
       echo 'method not allowed 405';
       die();
   }

   if($idgetarr == '' || $idgetarr == null){
    echo 'method not allowed 405';
    die();
   }


   if($key != $keyget){
    echo 'method not allowed 405';
    die();
   }

   if($shoplat == '' || $shoplat == null){
    echo 'method not allowed 405';
    die();
   }

   if($shoplng == '' || $shoplng == null){
    echo 'method not allowed 405';
    die();
   }

  
?>



<!DOCTYPE html>
<html>
  <head>
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
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        margin-left: -52px;
      }
    </style>
  </head>
  <body>
    
    <div id="map"></div>
    <script>


     var ar = '<?php echo $idgetarr ?>';
     var arr = JSON.parse(ar);
     var latsho = '<?php echo $shoplat  ?>';
     var lngsho = '<?php echo $shoplng ?>';
     var latshop = parseFloat(latsho);
     var lngshop = parseFloat(lngsho);
     
     

    

      
      var map;

      function initMap() {






        var geocoder = new google.maps.Geocoder;
        var myLatlng = new google.maps.LatLng(latshop,lngshop);
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 2,
          center: {lat:latshop, lng:lngshop}
        });

//setshop

    var latlng1 = {
    lat:latshop,
    lng:lngshop
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


            marker12 = new google.maps.Marker({
              position: latlng1,
              map: map,
              animation: google.maps.Animation.DROP,
              icon:'shop.png',
            });

            

            infowindow.open(map,marker12);
            map.panTo(marker12.getPosition());
            
           
          
            setTimeout(function(){
              map.setZoom(4);
              map.setCenter(marker12.getPosition());
            },600);


            google.maps.event.addListener(marker12, 'click', function(){
                           
                           map.setZoom(10);
                           map.setCenter(marker12.getPosition());
                           infowindow.open(map,marker12);
           });
                            
                           
                            

          
        },1 * 200);


    });

//end












        for (var i = 0; i < arr.length; i++) {



          var name = arr[i]['name'];
          var contct = arr[i]['contact'];
          var distance = arr[i]['distanse'];
          var ondilivery = arr[i]['ondilivery'];
          var lat = arr[i]['position'][0]['lat'];
          var lng = arr[i]['position'][0]['lng'];
          var myLatlng = new google.maps.LatLng(lat,lng);
          var timeout = i * 400;

          
          addmark(name,contct,distance,ondilivery,myLatlng,timeout,i);
          
         

        }

        function addmark(name,contct,distance,ondilivery,myLatlng,timeout,i){


           
                 var marker;
 
  
                if(ondilivery == 1){
                    window.setTimeout(function() {

                        var marker;
                        var infowindow;
                
                        var html =  '<div>Name: '+name+'</div><br>'+
                        '<div>Contact Number: '+contct+'</div><br>'+
                        '<div>Distance: '+distance+'</div>';

                        infowindow = new google.maps.InfoWindow({
                        content: html
                        });

          
         
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            animation: google.maps.Animation.DROP,
                            icon:'ondeliverytrue.png',
                           
                        });

                        infowindow.open(map, marker);

                        google.maps.event.addListener(marker, 'click', function(){
                            window.setTimeout(function() {
                                map.panTo(marker.getPosition());
                            }, 3000);
                            map.setZoom(10);
                            map.setCenter(marker.getPosition());
                            infowindow.open(map, marker);

                        });
                        

                       
                    },timeout);

                    
                }

                if(ondilivery == 0){
                    window.setTimeout(function() {

                        var marker;
                        var infowindow;
                
                        var html =  '<div>Name: '+name+'</div><br>'+
                        '<div>Contact Number: '+contct+'</div><br>'+
                        '<div>Distance: '+distance+'</div>';

                        infowindow = new google.maps.InfoWindow({
                        content: html
                        });


                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            animation: google.maps.Animation.DROP,
                            icon:'ondeliveryfalse.png',
                        });

                        infowindow.open(map, marker);

                        google.maps.event.addListener(marker, 'click', function(){
                             window.setTimeout(function() {
                                map.panTo(marker.getPosition());
                            }, 3000);
                            map.setZoom(10);
                            map.setCenter(marker.getPosition());
                            infowindow.open(map, marker);
                        });


                    },timeout);
                   
                }

                

                
                
               

                

               

        }

        



        

       
           
       


      }

      
        

      

      
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKSpo-16NwxmBwCupn2bw1rDT7uC3yh8M&callback=initMap">
    </script>
  </body>
</html>