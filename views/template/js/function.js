$(document).ready(function(){
      
  function initialize() {
			var latlng = new google.maps.LatLng(49.98679,36.2343);
			var settings = {
				zoom: 12,
				center: latlng,
				mapTypeControl: true,
				mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
				navigationControl: true,
				navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
				mapTypeId: google.maps.MapTypeId.ROADMAP};
			var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				
				var companyImage = new google.maps.MarkerImage('images/logo.png',
					new google.maps.Size(100,50),
					new google.maps.Point(0,0),
					new google.maps.Point(50,50)
				);

				var companyShadow = new google.maps.MarkerImage('images/logo_shadow.png',
					new google.maps.Size(130,50),
					new google.maps.Point(0,0),
					new google.maps.Point(65, 50));

				var companyPos = new google.maps.LatLng(57.0442, 9.9116);

				var companyMarker = new google.maps.Marker({
					position: companyPos,
					map: map,
					icon: companyImage,
					shadow: companyShadow,
					title:"Høgenhaug",
					zIndex: 3});
				
				var trainImage = new google.maps.MarkerImage('images/train.png',
					new google.maps.Size(50,50),
					new google.maps.Point(0,0),
					new google.maps.Point(50,50)
				);

				var trainShadow = new google.maps.MarkerImage('images/train_shadow.png',
					new google.maps.Size(70,50),
					new google.maps.Point(0,0),
					new google.maps.Point(60, 50)
				);

				var trainPos = new google.maps.LatLng(57.0429, 9.9173);

				var trainMarker = new google.maps.Marker({
					position: trainPos,
					map: map,
					icon: trainImage,
					shadow: trainShadow,
					title:"Train Station",
					zIndex: 2
				});

				var parkingImage = new google.maps.MarkerImage('images/parking.png',
					new google.maps.Size(50,50),
					new google.maps.Point(0,0),
					new google.maps.Point(50,50)
				);

				var parkingShadow = new google.maps.MarkerImage('images/parking_shadow.png',
					new google.maps.Size(70,50),
					new google.maps.Point(0,0),
					new google.maps.Point(60, 50)
				);

				var parkingPos = new google.maps.LatLng(57.0437, 9.9147);

				var parkingMarker = new google.maps.Marker({
					position: parkingPos,
					map: map,
					icon: parkingImage,
					shadow: parkingShadow,
					title:"Parking Lot",
					zIndex: 1
				});
				
				google.maps.event.addListener(companyMarker, 'click', function() {
					infowindow.open(map,companyMarker);
				});
			}
});