//variaveis globais
var doencas = "";
var marcadores = [];
var map;
var isFirst = true;
$(document).ready(function () {

  carregar_doencas();//carregando doenças no select

  //carregando o mapa
  var script = document.createElement('script');
  script.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyBzzVO9xReGMoS9WHTDWaFilMa23SyHPC4&callback=initialize";
  document.body.appendChild(script);

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
  reload_marcadores();
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

function setar_marcadores() {
  var bounds = new google.maps.LatLngBounds();
  var infoWindow = new google.maps.InfoWindow(), marker, i;
  var temp;
  if(isFirst){
    temp = [["INIT", -28.6315351, -53.0972222, '']];
  }else{
    temp = carregar_marcadores();
  }

  // Posicionando cada marcador 
  for (i = 0; i < temp.length; i++) {

    var position = new google.maps.LatLng(parseFloat(temp[i][1]), parseFloat(temp[i][2]));
    bounds.extend(position);
    marker = new google.maps.Marker({
      position: position,
      map: (isFirst)? null:map,
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
    
    // Centra o mapa automaticamente
    map.fitBounds(bounds);
    // array com os marcadores atuais
    marcadores.push(marker);
  }
  
  // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
  var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
    this.setZoom(12);
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
    setar_marcadores();
}

function carregar_marcadores() {
  var cfixo = '<h3>:NOME</h3><div class="clearfix float-my-children" >' +
	  '<img class="avatar" src="../webroot/img/:IMG"/>' +
	  '<ul><li>SEXO::SEXO</li><li>IDADE::IDADE</li>' +
	  '<li>CIDADE::CID</li>' + '<li>ENDEREÇO::END</li><p>DOENÇAS:DOE</li></ul></div>';
  var conteudo;
  var temp = [];
  $.post({
    url: "./get_dados.php",
    data: {funcao: 2, doencas: doencas},
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