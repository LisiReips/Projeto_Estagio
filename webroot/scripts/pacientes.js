$(document).ready(function(){
  
  pesquisar_pacientes("1901-01-01","2118-01-01","A","");
  
  $("#gerar").click(function(){
    var inicial = $("#inicial").val();
    var final = $("#final").val();
    
    $.post(
      "./gerar_aniver.php",
      {inicial:inicial,final:final,gerar:1},
      function(data){
        console.log(data);
        if(data){
          window.open("./aniversariantes.xlsx","_blank");
        }
        location.reload();
      }
    );
    
  });
  
  $("#nome").keyup(function(){
    $("#tabela").empty();
    var nome = $("#nome").val();
    
    if(nome.length >= 3){
      pesquisar_pacientes("","","",nome);
    }
  });
  
  $("#pesquisar").click(function(){
    $("#tabela").empty();
    var inicial = $("#inicial").val();
    var final = $("#final").val();
    var sexo = $("#sexo").val();
    
    pesquisar_pacientes(inicial,final,sexo,"");
    
  });
  
});

function pesquisar_pacientes(inicial,final,sexo,nome){
    $.post(
      "./dados_pacientes.php",
      {inicial:inicial,final:final,nome:nome,
        sexo:sexo,funcao:1},
      function(data){
        var json = $.parseJSON(data);
        var html = "";
        $(json).each(function(i,val){
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