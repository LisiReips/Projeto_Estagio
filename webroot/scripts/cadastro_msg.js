$(document).ready(function () {
  carregar_mensagens();
  $(".js-basic").select2({});

  $("#form_filtros").submit(function () {
    var dataid = $("#gravar").attr("data-id");
    var funcao;

    if (dataid == "0") {
      funcao = 1;
    } else {
      funcao = 2;
    }
      gravar(funcao);
  });

  $("#existentes").change(function () {
    carregar_mensagem($(this).val());
  });

  $("#deletar").click(function () {
    var dataid = $(this).attr("data-id");
    if (dataid == 0) {
      alert("Nenhum registro selecionado!");
    } else {
      deletar(dataid);
    }
  });

});

function gravar(funcao) {
  var titulo = $("#titulo").val();
  var msg = $("#mensagem").val();
  var data = $("#data").val();
  var id = $("#gravar").attr("data-id");

  $.post(
          "./cadastro_msg.php",
          {funcao: funcao, titulo: titulo, mensagem: msg, data: data, id: id},
          function (data) {
            if (data == 0) {
              alert("Erro ao gravar/alterar o registro!");
            } else {
              alert("O registro foi gravado com sucesso!");
              location.reload();
            }
          }
  );

}

function carregar_mensagens() {

  $.post(
          "./cadastro_msg.php",
          {funcao: 4, id: -1},
          function (data) {
            var dados = $.parseJSON(data);
            $(dados).each(function (i, val) {
              $("#existentes").append($("<option>").attr("value", val.id).text(val.titulo));
            });
          }
  );
}

function carregar_mensagem(id) {
  $.post(
          "./cadastro_msg.php",
          {funcao: 4, id: id},
          function (data) {
            var dados = $.parseJSON(data);
            $(dados).each(function (i, val) {
              $("#titulo").attr("value", val.titulo);
              $("#mensagem").attr("value", val.mensagem).html(val.mensagem);
              $("#data").attr("value", val.data_envio);
              $("#gravar").attr("data-id", val.id);
              $("#deletar").attr("data-id", val.id);
            });
          }
  );
}

function deletar(id) {
  $.post(
          "./cadastro_msg.php",
          {funcao: 3, id: id},
          function (data) {
            if (data == 0) {
              alert("Erro ao deletar o registro!");
            } else {
              alert("O registro foi deletado com sucesso!");
              location.reload();
            }
          }
  );
}