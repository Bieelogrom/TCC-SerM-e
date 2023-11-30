$(document).ready(function () {
    var modal = $('#modalDenuncia');
    var fade = $('#fadeDenuncia');
    var arr = [modal, fade];

    // arr.forEach((el) => el.toggleClass("hide"))

  $(".bxs-check-circle").on("click", function () {
    $("#modalDenuncia").toggleClass("hide");
    var id_da_publicacao = $(this).attr('id')
    var denc = 1
    console.log(id_da_publicacao)
    if(id_da_publicacao !== ""){
      var responderDenuncia = {
        id_da_publicacao: id_da_publicacao,
        denc: denc
      }
    }

    $.post('../../Controller/administradorController.php', responderDenuncia, function(resposta_denuncia){
        $('.idUser').text(resposta_denuncia.idUsuario);
        $('.nome_denunciador').text(resposta_denuncia.nomeUsuario);
        $('.email_denunciardor').text(resposta_denuncia.emailUsuario);
    });
  });

  $('#fecharModalDenuncia').on("click", function(){
    $("#modalDenuncia").toggleClass("hide")
  });

});
