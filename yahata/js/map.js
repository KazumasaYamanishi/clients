function initialize() {
	var latlng = new google.maps.LatLng(31.570112, 130.556484);
	var opts = {
		zoom: 16,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("map"), opts);
	var marker = new google.maps.Marker({
		position: latlng,
		map: map
	});
}