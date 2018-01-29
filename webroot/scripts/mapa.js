//variaveis globais
var doencas = "";
var marcadores;
var script = document.createElement('script');
script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyBzzVO9xReGMoS9WHTDWaFilMa23SyHPC4&callback=initialize";

$(document).ready(function () {

  carregar_doencas();//carregando doenças no select

  //quando clicar para selecionar a doença
  $("#selShowDoencas").click(function () {
    $(this).toggleClass("active");
    $("#selectDoencas").slideToggle(400);
  });

  //quando o mouse sair da seleção
  $("#divDoencas").mouseleave(function () {
    if ($(this).children().hasClass("active")) {
      $(this).children().trigger("click");
    }
  });

});

//quando clicar no botao pesquisar
$("#btn_pesq").click(function () {
  doencas = $(".opDoencas:checked").map(function () {
    return this.value;
  }).get().join(",");

  if (doencas === "") {
    alert("Nenhuma doença selecionada!");
    return false;
  }
  carregar_mapa();
});

$(document).on("click", "li", function () {
  var ck = $(this).find('input:checkbox');

  if (ck.attr("checked")) {
    ck.attr("checked", false);
  } else {
    if (ck.val() == "0") {
      $('.active').trigger("click");
      $('.' + ck.attr("class")).each(function () {
	$(this).attr("checked", false);
      });
    }
    ck.attr("checked", true);
  }
});

function carregar_mapa() {
  $("script[src='" + script.src + "']").remove();//removendo mapa
  document.body.appendChild(script); //carregando o mapa
}

function carregar_doencas() {
  $("#selectDoencas").append("<li><input type='checkbox' name='doencas' class='opDoencas' value='0'>TODAS<br></li>");
  $.post(
    "./get_dados.php",
    {funcao: 1},
    function (data) {
      var json = $.parseJSON(data);
      $(json).each(function (i, val) {
        $("#selectDoencas").append("<li><input type='checkbox' name='doencas' class='opDoencas' value=" + val.id + ">" + val.abrev + "<br></li>");
      });
    }
  );
}

function initialize() {
  var map;
  var bounds = new google.maps.LatLngBounds();
  var mapOptions = {
    mapTypeId: 'roadmap'
  };
  // exibe o mapa
  map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
  map.setTilt(45);

  //carregando os marcadores
  var marcadores = carregar_marcadores();
  console.log(marcadores);
  var infoWindow = new google.maps.InfoWindow(), marker, i;

  // Posicionando cada marcador 
  for (i = 0; i < marcadores.length; i++) {
    
    var position = new google.maps.LatLng(parseFloat(marcadores[i][1]), parseFloat(marcadores[i][2]));
    bounds.extend(position);
    marker = new google.maps.Marker({
      position: position,
      map: map,
      title: marcadores[i][0]
    });
    marker.setIcon('../webroot/img/marcador.png');

    // Cada marcador tera uma janela  
    google.maps.event.addListener(marker, 'click', (function (marker, i) {
      return function () {
	infoWindow.setContent("<div class='info_content'>" + marcadores[i][3] + "</div>");
	infoWindow.open(map, marker);
      }
    })(marker, i));

    // Centra o mapa automaticamente
    map.fitBounds(bounds);
  }

  // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
  var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
    this.setZoom(12);
    google.maps.event.removeListener(boundsListener);
  });
}

function carregar_marcadores() {
  var marcadores = [];
  var cfixo = '<h3>:NOME</h3><div class="clearfix float-my-children" >' +
	      '<img class="avatar" src="../webroot/img/:IMG"/>' + 
	      '<p>SEXO::SEXO</p><p>CIDADE::CID</p>' + '<p>ENDEREÇO::END</p><p>DOENÇAS:DOE</p></div>';
  var conteudo;
  $.post({
    url: "./get_dados.php",
    data: {funcao: 2,doencas:doencas},
    async : false
  },function (data) {
      var json = $.parseJSON(data);
      $(json).each(function(i,val){
	var marcador = [];
	conteudo = cfixo;
	conteudo = conteudo.replace(":NOME",val.nome).replace(":IMG",val.caminho_img).replace(":DOE",val.doencas);
	conteudo = conteudo.replace(":SEXO",val.sexo).replace(":END",val.rua + ", " + val.num + ", " + val.complemento + 
	        " " + val.bairro + ",<br>" + val.cidade);
	marcador.push(val.nome,val.latitude,val.longitude,conteudo);
	marcadores.push(marcador);
      });
    });
  return marcadores;
}