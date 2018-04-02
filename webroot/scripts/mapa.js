//variaveis globais
var marcadores = [];
var map;
var isFirst = true;
$(document).ready(function () {
  
  $("#cidades").change(function () {
    $("#bairros").empty();
  });

  //carregando o mapa
  var script = document.createElement('script');
  script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyCKxBgMAn1khyrbRgxMYDTCDQY0e1BKpKE&callback=initialize";
  document.body.appendChild(script);
  
  if(findGet('x') == "1"){
    alternar_filtros();
  }
  
});

/*
 $('select').on('select2:open', function(e) {
 $('.select2-search input').prop('focus',false);
 });
 */

$("#form_filtros").submit(function () {
  reload_marcadores();
  $("#filtros").hide();
  $("#map_wrapper").show();
  return false;
});

function alternar_filtros() {
  $("#map_wrapper").hide();
  $("#filtros").show();

  if (isFirst) {
    preparar_filtros();
  }

};

function preparar_filtros() {
  $('select').select2();

  $('#doencas').select2({
    placeholder: "SELECIONE AS DOENÇAS",
    minimumInputLength: 2,
    maximumResultsForSearch: 15,
    ajax: {
      url: './get_dados.php',
      dataType: 'json',
      type: 'POST',
      quietMillis: 50,
      data: function (params) {
        var query = {
          procura: params.term,
          funcao: 1
        };
        return query;
      },
      processResults: function (data) {
        var arr = [];
        $(data).each(function (i, val) {
          arr.push({
            id: val.id,
            text: val.abrev
          });
        });
        return {results: arr};
      }
    }
  });

  $('#idades').select2({
    placeholder: "SELECIONE A IDADE"
  });

  $('#bairros').select2({
    placeholder: "SELECIONE OS BAIRROS"
  });

  $('#cidades').select2({
    placeholder: "SELECIONE AS CIDADES",
    minimumInputLength: 3,
    maximumResultsForSearch: 15,
    ajax: {
      url: './get_dados.php',
      dataType: 'json',
      type: 'POST',
      quietMillis: 50,
      data: function (params) {
        var query = {
          procura: params.term,
          funcao: 2
        };
        return query;
      },
      processResults: function (data) {
        var arr = [];
        $(data).each(function (i, val) {
          arr.push({
            id: val.cidade,
            text: val.cidade
          });
        });
        return {results: arr};
      }
    }
  });

  $('#bairros').select2({
    placeholder: "SELECIONE OS BAIRROS",
    minimumInputLength: 3,
    maximumResultsForSearch: 15,
    ajax: {
      url: './get_dados.php',
      dataType: 'json',
      type: 'POST',
      quietMillis: 50,
      data: function (params) {
        var query = {
          procura: params.term,
          funcao: 3,
          cidades: $("#cidades").val().join(",")
        };
        return query;
      },
      processResults: function (data) {
        var arr = [];
        $(data).each(function (i, val) {
          arr.push({
            bairro: "'" + val.bairro + "'",
            text: val.bairro
          });
        });
        return {results: arr};
      }
    }
  });
}

function setar_marcadores() {
  console.log("B");
  var bounds = new google.maps.LatLngBounds();
  var infoWindow = new google.maps.InfoWindow(), marker, i;
  var temp;
  if (isFirst) {
    temp = [["Clínica CIEMP", -28.6324149, -53.0905275, '']];
  } else {
    temp = carregar_marcadores();
  }

  // Posicionando cada marcador 
  for (i = 0; i < temp.length; i++) {

    var position = new google.maps.LatLng(parseFloat(temp[i][1]), parseFloat(temp[i][2]));
    bounds.extend(position);
    marker = new google.maps.Marker({
      position: position,
      map: map,
      animation: google.maps.Animation.DROP,
      title: temp[i][0]
    });
    marker.setIcon('../webroot/img/marcador.png');

    // Cada marcador tera uma janela  
    google.maps.event.addListener(marker, 'click', (function (marker, i) {
      return function () {
        infoWindow.setContent("<div class='info_content'>" + temp[i][3] + "</div>");
        infoWindow.open(map, marker);
      }
    })(marker, i));

    // array com os marcadores atuais
    marcadores.push(marker);
  }
  
  // Evitar zoom em um marcador unico
  if (bounds.getNorthEast().equals(bounds.getSouthWest())) {
    var extendPoint1 = new google.maps.LatLng(bounds.getNorthEast().lat() + 0.01, bounds.getNorthEast().lng() + 0.01);
    var extendPoint2 = new google.maps.LatLng(bounds.getNorthEast().lat() - 0.01, bounds.getNorthEast().lng() - 0.01);
    bounds.extend(extendPoint1);
    bounds.extend(extendPoint2);
  }

  // Centra o mapa automaticamente
  map.fitBounds(bounds);

  // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
  var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
    this.setZoom(15);
    google.maps.event.removeListener(boundsListener);
  });

}

function initialize() {
  var mapOptions = {
    mapTypeId: 'roadmap'
  };
  // exibe o mapa
  map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
  map.setTilt(45);

  setar_marcadores();
}

function reload_marcadores() {
  for (var i = 0; i < marcadores.length; i++) {
    marcadores[i].setMap(null);
  }
  isFirst = false;
  marcadores = [];
  console.log("A");
  setar_marcadores();
}

function carregar_marcadores() {
  var doencas = $("#doencas").val();
  var cidades = $("#cidades").val();
  var bairros = $("#bairros").val();
  var idade = $("#idade").val();
  var sexo = $("#sexo").val();

  var cfixo = '<h3>:NOME</h3>' +
          '<div class="clearfix float-my-children" >' +
          '<img class="avatar" src="../webroot/img/:IMG"/>' +
          '<ul class="ul">' +
          '<li class="li">SEXO: :SEXO</li>' +
          '<li class="li">IDADE: :IDADE</li>' +
          '<li class="li">CIDADE: :CID</li>' +
          '<li class="li">ENDEREÇO: :END</li>' +
          '<li class="li">DOENÇAS: :DOE</li>' +
          '</ul>' +
          '</div>';
  var conteudo;
  var temp = [];
  $.post({
    url: "./get_dados.php",
    data: {funcao: 4, doencas: doencas.join(","), cidades: cidades.join(","),
      bairros: bairros.join(","), idade: idade, sexo: sexo},
    async: false
  }, function (data) {
    marcadores = [];
    var json = $.parseJSON(data);
    $(json).each(function (i, val) {
      var marcador = [];

      conteudo = cfixo;
      conteudo = conteudo.replace(":NOME", val.nome).replace(":IMG", val.caminho_img).replace(":DOE", val.doencas).replace(":CID", val.cidade);
      conteudo = conteudo.replace(":SEXO", val.sexo).replace(":END", val.rua + ", " + val.num + ", " + val.complemento + " " + val.bairro);
      conteudo = conteudo.replace(":IDADE", val.idade);

      marcador.push(val.nome, val.latitude, val.longitude, conteudo);
      temp.push(marcador);
    });
  });
  return temp;
}

function findGet(name) {
  var $_GET = {};
  document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
      return decodeURIComponent(s.split("+").join(" "));
    }
    $_GET[decode(arguments[1])] = decode(arguments[2]);
  });
  return $_GET[name];
}