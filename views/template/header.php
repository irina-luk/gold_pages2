<?php defined('GOLD') or exit('Access denied');?>

<!DOCTYPE HTML>
<html>
<head>
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
	<script type="text/javascript">
		function initialize() {
		   var lat = $.cookie("lat");
         var lng = $.cookie("lng"); 
//		 alert('lat = ' + lat + 'lng = ' + lng);
         if (lat <= 0) {            lat = 50.0053767;         }
         if (lng <= 0) {            lng =  36.2314594;         }
//		 alert('lat = ' + lat + 'lng = ' + lng);
			var latlng = new google.maps.LatLng(lat, lng);
			var settings = {
				zoom: 14,
				center: latlng,
				mapTypeControl: true,
				mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
				navigationControl: true,
				navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
				mapTypeId: google.maps.MapTypeId.ROADMAP};
			var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
			var infowindow = new google.maps.InfoWindow({});		
			
			//var marker = new GMarker(new GLatLng(lat, lng)); 
			//map.addOverlay(marker); 
			var companyImage = new google.maps.MarkerImage('../../views/template/js/images/marker.png',
				new google.maps.Size(100,100),
				new google.maps.Point(0,0),
				new google.maps.Point(50,50)
			);
			var companyMarker = new google.maps.Marker({
				position: latlng,
				map: map,
				icon: companyImage,
				zIndex: 3});
		}
	</script>
      
    <?php  if(isset($styles)) :?>
    	<?php  foreach($styles as $style) :?>
    		<link rel="stylesheet" type="text/css" href="<?php echo $style;?>" />
    	<?php  endforeach;?>
    <?php  endif; ?>
    
    <?php  if(isset($scripts)) :?>
    	<?php  foreach($scripts as $script) :?>
    		<script type="text/javascript" src="<?php echo $script;?>"></script>
    	<?php  endforeach;?>
    <?php  endif; ?>
    
	<title><?php echo $title; ?></title>
</head>

<body onload="initialize()">
	<noscript><span>Включите, пожалуйста, JavaScript...</span></noscript>
	
   <header>
      <div>         
   		<form action="<?php echo SITE_URL; ?>search" method="post" id="frm-search" class="search-form">
            <fieldset>
               <input type="text" id="search_firm" class="search-name" placeholder="Что?" name="what" value=""  />
               <input type="text" id="search_map" class="search-address" name="where" placeholder="Где?" value=""  />
               <input type="submit" value="Поиск" class="button_search" title="поиск" />
            </fieldset>
   		</form>
          <a href="<?php echo SITE_URL; ?>" class="logo" title="Харьков. Золотые Страницы"><span>ХАРЬКОВ<br />ЗОЛОТЫЕ<br />СТРАНИЦЫ</span></a>
      </div>
      <hr />
        <ul class="menu">
            <!-- MENU -->
            <li><a href="<?php echo SITE_URL; ?>">Главная</a></li>
            <!-- MENU -->
        </ul>
      <hr />
   </header>