$(document).ready(function () {
  var n_page = 1;
  var inicial = "1901-01-01";
  var final = "2118-01-01";
  var sexo = "A";

  pesquisar_pacientes(inicial, final, sexo, "", n_page);
  $("#proximo").click(function () {
    n_page++;
    pesquisar_pacientes(inicial, final, sexo, "", n_page);
    return false;
  });

  $("#anterior").click(function () {
    if (n_page != 1) {
      n_page--;
      pesquisar_pacientes(inicial, final, sexo, "", n_page);
    }
    return false;
  });

  $("#gerar").click(function () {
    inicial = $("#inicial").val();
    final = $("#final").val();
    if (!data_valida(inicial, final) || (is_invalid(inicial) && is_invalid(final))) {
      alert("Datas inválidas!");
      return false;
    }

    $.post(
	    "./gerar_aniver.php",
	    {inicial: inicial, final: final, gerar: 1},
	    function (data) {
	      console.log(data);
	      if (data) {
		window.open("./aniversariantes.xlsx", "_blank");
	      }
	      location.reload();
	    }
    );

  });

  $("#nome").keyup(function () {
    n_page = 1;
    $("#tabela").empty();
    var nome = $("#nome").val();

    if (nome.length >= 3) {
      pesquisar_pacientes("", "", "", nome, 0);
    }
  });

  $("#pesquisar").click(function () {
    $("#tabela").empty();
    n_page = 1;
    var inicial = $("#inicial").val();
    var final = $("#final").val();
    var sexo = $("#sexo").val();
    if (!data_valida(inicial, final) || (is_invalid(inicial) && is_invalid(final))) {
      alert("Datas inválidas!");
      return false;
    }

    pesquisar_pacientes(inicial, final, sexo, "", n_page);
  });

});

function pesquisar_pacientes(inicial, final, sexo, nome, n_page) {
  $.post(
	  "./dados_pacientes.php",
	  {inicial: inicial, final: final, nome: nome,
	    sexo: sexo, n_page: n_page, funcao: 1},
	  function (data) {
	    var json = $.parseJSON(data);
	    var html = "";
	    $(json).each(function (i, val) {
	      html += "<tr>" +
		      "<td>" + val.prontuario + "</td>" +
		      "<td>" + val.nome + "</td>" +
		      "<td>" + val.nascimento + "</td>" +
		      "<td>" + val.sexo + "</td>" +
		      "<td>" + val.email + "</td>" +
		      "<td>" + val.telefone + "</td>" +
		      "</tr>";

	    });
	    $("#tabela").html(html);
	  }
  );
}

function data_valida(data_ini, data_fim) {
  if (Date.parse(data_ini) <= Date.parse(data_fim)) {
    return true;
  } else {
    return false;
  }
}

function is_invalid(variavel) {
  switch (variavel) {
    case null:
      return true;
    case false:
      return true;
    case "":
      return true;
    case undefined:
      return true;
    default:
      return false;
  }
}