 <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<style>

			.map{width:640px;height:480px}





		</style>
		<script src="//maps.google.com/maps/api/js?key=AIzaSyCOR9r_QnT2evmaj4B_Uc_Vqfd2VOe4MnQ&amp;sensor=false&amp;libraries=geometry&amp;language=zh-TW"></script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>    
	    <script src="javascripts/jquery.tinyMap-2.8.1.js"></script>
	</head>
<body>

    <div id="info"></div>

    <div class="map" id="map"></div>

    
    <script>

    

    $('#map').tinyMap({
        center: '臺北市大安區羅斯福路四段一號',
        zoom: 15,
        direction : [{
            'from': '臺北市大安區羅斯福路四段一號',
            'waypoint': [
                '台北市信義區仁愛路4段505號',
                '臺北市松山區南京東路4段2號'
            ],
            'to': '臺北市北平西路三號',
            'travel': 'driving',
            'panel': '#direction-panel'

        }]

    });


    </script>

</body>
</html>
