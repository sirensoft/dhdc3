var layer_line = L.mapbox.featureLayer();
var direction = function (origin, destination) {
    var directionsService = new google.maps.DirectionsService();
    var directionsRequest = {
        origin: origin,
        destination: destination,
        travelMode: google.maps.DirectionsTravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
    };
    return new Promise(function (resolve, reject) {
        directionsService.route(directionsRequest, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                var route = response.routes[0].overview_polyline;
                var descript = response.routes[0].legs[0];
                //console.log(descript)
                var data = {
                    route: route,
                    descript: {
                        distance: descript.distance.text,
                        duration: descript.duration.text
                    }

                };
                resolve(data)
            } else {
                reject("ผิดพลาด:" + status)
            }
        })
    });
};

function calDirect() {
    var origin = markerA.getLatLng().lat + ',' + markerA.getLatLng().lng;
    var destination = markerB.getLatLng().lat + ',' + markerB.getLatLng().lng;
    direction(origin, destination).then(function (result) {
        var json_line = polyline.toGeoJSON(result.route);
        layer_line.remove();
        layer_line.setGeoJSON(json_line)
                .setStyle({
                    weight: 5,
                    color: 'blue'
                }).addTo(map);
        var pop = result.descript.distance + " ," + result.descript.duration;
        layer_line.bindPopup('รถยนต์ : ' + pop);
        layer_line.openPopup();
        //console.log(pop)
    }, function (err) {
        alert(err)
    });
}