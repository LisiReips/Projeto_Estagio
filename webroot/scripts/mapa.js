jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyBzzVO9xReGMoS9WHTDWaFilMa23SyHPC4&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
    // exibe o mapa
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);

    // Multiple Markers
    var markers = loadMarkers("dados.txt");

    // Conteudo da janela, vai ser a ordem dos marcadores(acima)
    var infoWindowContent = loadContent("conteudo.txt");

    // Exibindo os marcadores
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Posicionando cada marcador 
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(parseFloat(markers[i][1]), parseFloat(markers[i][2]));
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            //category: category,
            map: map,
            title: markers[i][0]
        });
        marker.setIcon('../webroot/img/marcador.png');
    
        // Cada marcador tera uma janela  
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent("<div class='info_content'>"+infoWindowContent[i][0]+"</div>");
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Centra o mapa automaticamente
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(12);
        google.maps.event.removeListener(boundsListener);
    });
}

/*filterMarkers = function (category) {
    for (i = 0; i < markers1.length; i++) {
        marker = gmarkers1[i];
        // If is same category or category not picked
        if (marker.category == category || category.length === 0) {
            marker.setVisible(true);
        }
        // Categories don't match 
        else {
            marker.setVisible(false);
        }
    }
}*/

function loadMarkers(file){
  var markers = [];
  var temp = [];
  var conteudo = readTextFile(file);
  conteudo = conteudo.split("\n");
  $(conteudo).each(function(i,val){
    temp = val.split(",");
    markers.push(temp);
  });
  return markers;
}

function loadContent(file){
  var conteudoCaixa = [];
  var conteudo = readTextFile(file).split("\n");

  $(conteudo).each(function(i,val){
    conteudoCaixa.push([val]);
  });
  return conteudoCaixa;
}

function readTextFile(file){
  var allText
  var rawFile = new XMLHttpRequest();
  rawFile.open("GET", file, false);
  rawFile.onreadystatechange = function (){
    if(rawFile.readyState === 4 && (rawFile.status === 200 || rawFile.status == 0)){
      allText = rawFile.responseText;
    }
  }
  rawFile.send(null);
  return allText;
}