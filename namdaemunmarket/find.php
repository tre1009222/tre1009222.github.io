<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service</title>
    <style type="text/css">
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }

        #map-canvas, #map_canvas {
          height: 70%;
        }

        @media print {
          html, body {
            height: auto;
          }

          #map_canvas {
            height: 650px;
          }
        }

        #panel {
          position: absolute;
          top: 5px;
          left: 50%;
          margin-left: -180px;
          z-index: 5;
          background-color: #fff;
          padding: 5px;
          border: 1px solid #999;
        }
    </style>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language="></script> -->
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3.exp&region=KR&key=AIzaSyDvj3CQnnx-MXHopDtN_jbPAQtMPKPbcy0&language="></script>
    <script>
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;
    var browserSupportFlag =  new Boolean();

    function initialize() {
      directionsDisplay = new google.maps.DirectionsRenderer();
      var ndm = new google.maps.LatLng(37.559417, 126.977680);
      var mapOptions = {
        zoom:18,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: ndm
      }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      directionsDisplay.setMap(map);
      directionsDisplay.setPanel(document.getElementById("directionsPanel"));
    }

    function calcRoute(startPosition, startMyPosition) {
		var start = startPosition;
		var end = new google.maps.LatLng(37.559417, 126.977680);
      	var mode = "TRANSIT";

      	if(startMyPosition == 'Y' && navigator.geolocation) {
        	browserSupportFlag = true;

    	  	navigator.geolocation.getCurrentPosition(function(position) {
    	  		start = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

    	  		var request = {
    	  	          	origin:start,
    	  	          	destination:end,
    	  	          	travelMode: eval("google.maps.DirectionsTravelMode."+mode)
    	  	      	};

    	  	      	directionsService.route(request, function(response, status) {
    	  	          	if (status == google.maps.DirectionsStatus.OK) {
    	  				  	//alert("출발지를 찾았습니다.");
    	  	              	directionsDisplay.setDirections(response);
    	  	          	}
    	  	          	else {
    	  	              	alert("출발지를 찾지 못했습니다.");
    	  	              	//location.href="widget_input.php";
    	  	          	}
    	  	      	});
      	  	}, function() {
    	      	handleNoGeolocation(browserSupportFlag);
    	  	});
      	}
      	else if(start != "")
      	{
      		var request = {
	  	          	origin:start,
	  	          	destination:end,
	  	          	travelMode: eval("google.maps.DirectionsTravelMode."+mode)
	  	      	};

	  	      	directionsService.route(request, function(response, status) {
	  	          	if (status == google.maps.DirectionsStatus.OK) {
	  				  	alert("출발지를 찾았습니다.");
	  	              	directionsDisplay.setDirections(response);
	  	          	}
	  	          	else {
	  	              	alert("출발지를 찾지 못했습니다.");
	  	              	//location.href="widget_input.php";
	  	          	}
	  	      	});
      	}
      	else
      	{
          	alert("현재 위치를 알 수 없습니다. 출발지를 입력해 주세요.");
          	//location.href="widget_input.php";
      	}
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    </head>
    <body onLoad="calcRoute('', 'Y');">
    	<div id="directionsPanel" style="float:left;width:30%;height 100%"></div>
        <div id="map-canvas" style="float:right;width:70%; height:100%"></div>
    </body>
</html>
