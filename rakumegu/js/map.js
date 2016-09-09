function initialize() {
	// 菱田保育園
	var latlngHishida = new google.maps.LatLng(31.441156, 131.037654);
	var optsHishida = {
		zoom: 13,
		center: latlngHishida,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var mapHishida = new google.maps.Map(document.getElementById("map-hishida"), optsHishida);
	var markerHishida = new google.maps.Marker({
		position: latlngHishida,
		map: mapHishida
	});

	// 中沖保育園
	var latlngNakaoki = new google.maps.LatLng(31.457437, 131.020205);
	var optsNakaoki = {
		zoom: 13,
		center: latlngNakaoki,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var mapNakaoki = new google.maps.Map(document.getElementById("map-nakaoki"), optsNakaoki);
	var markerHishida = new google.maps.Marker({
		position: latlngNakaoki,
		map: mapNakaoki
	});

	// あすなろクラブ
	var latlngAsunaro = new google.maps.LatLng(31.441156, 131.037654);
	var optsAsunaro = {
		zoom: 13,
		center: latlngAsunaro,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var mapAsunaro = new google.maps.Map(document.getElementById("map-asunaro"), optsAsunaro);
	var markerHishida = new google.maps.Marker({
		position: latlngAsunaro,
		map: mapAsunaro
	});

	// 寺子屋クラブ
	var latlngTerakoya = new google.maps.LatLng(31.446214, 131.046077);
	var optsTerakoya = {
		zoom: 13,
		center: latlngTerakoya,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var mapTerakoya = new google.maps.Map(document.getElementById("map-terakoya"), optsTerakoya);
	var markerHishida = new google.maps.Marker({
		position: latlngTerakoya,
		map: mapTerakoya
	});
}