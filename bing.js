$(document).ready(function() {
	GetMap();
});


var map = null;
var credentials = "AhPuv-6lkVFe36dKaBwhyWvKklVXBWTKBXvmUBcWEI7V8ds9e38-GgjVSxM6oYIs";

function GetMap() {

	var geocodeRequest = 'http://dev.virtualearth.net/REST/v1/Locations?';
	
	var geoForm = ['addressLine', 'locality', 'adminDistrict', 'postalCode', 'countryRegion', 'key'];
	for (var i=0; i<geoForm.length; i++) {
		var val = $('#geoForm input[name*="'+geoForm[i]+'"]').val();
		geocodeRequest += geoForm[i]+'='+val+'&';
	}
	
	geocodeRequest += 'jsonp=GeocodeCallback';
			
	CallRestService(geocodeRequest);
	
}

function GeocodeCallback(result) {

	// generate map
	map = new Microsoft.Maps.Map(document.getElementById('geoMap'),
	{
		credentials: credentials,
		center: new Microsoft.Maps.Location(54.2395, -2.9003),
		mapTypeId: Microsoft.Maps.MapTypeId.road,
		zoom: 5
	});
  	
	var cnt = result.resourceSets[0].resources.length;
	var str = '<p>'+cnt+' location(s) found.</p>';

	// check that we have a valid response
	if (result && result.resourceSets && result.resourceSets.length > 0 && result.resourceSets[0].resources && result.resourceSets[0].resources.length > 0) {
	
		var marker = new Array;
		
		for(var i=0; i<cnt; i++) {

			var coords = result.resourceSets[0].resources[i].point.coordinates;
			var centerPoint = new Microsoft.Maps.Location(coords[0], coords[1]);
			
			// add marker
			var num = eval(i+1);
			marker[i] = new Microsoft.Maps.Pushpin(centerPoint);
			marker[i].setOptions({text: num+''});
			map.entities.push(marker[i]);
			
			var address = result.resourceSets[0].resources[i].address.formattedAddress;
			str += '<p>'+num+': '+address+'<br/>Lat: '+coords[0]+'<br/>Lng: '+coords[1]+'</p>';
		
		}		
	
	}

	$('#geoResult').html(str);

}

// This is a generic function to call a REST service and insert the JSON
// results into the head of the document
function CallRestService(request) {
	var script = document.createElement("script");
	script.setAttribute("type", "text/javascript");
	script.setAttribute("src", request);
	var dochead = document.getElementsByTagName("head").item(0);
	dochead.appendChild(script);
}
