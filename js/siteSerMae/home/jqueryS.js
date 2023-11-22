

$(document).ready(function() {
    $(document).on('click', '.fa-bookmark', function() {
        var idPublicacao = $(this).attr("id");
        var idUsuario = $('#id_do_usuario').val();
        var itemSalvo = $(this).hasClass('salvo');
        // console.log("ID do usuario = "+ idUsuario)
        // console.log("ID da publicação = "+ idPublicacao)
        if (idPublicacao !== '' && idUsuario !== '') {
            var dados = {
                idPublicacao: idPublicacao,
                idUsuario: idUsuario,
                acao: itemSalvo ? 'remover' : 'salvar'
            };
        };
        $.post("./SALVAR.php", dados, function(retorna) {
            if (itemSalvo) {
                $('.fa-bookmark').removeClass('salvo');
            } else {
                $('.fa-bookmark').addClass('salvo');
            }
            $('.fa-bookmark').html(retorna)
            $('.fa-bookmark').css({
                "background-color": "salmon",
                "color": "salmon"
            })
        }).fail(function(xhr, status, error) {
            console.log("Ocorreu um erro na requisição: " + error);
        })
    })

    $(document).on('click', '.fa-heart', function() {
        var idPublicacao = $(this).attr("id");
        var curtida = 0;
        var idUsuario = $('#id_do_usuario').val();

        // alert(curtida + idPublicacao + idUsuario)
        if (curtida !== '' && idPublicacao !== '' && idUsuario !== '') {
            var infos = {
                idPublicacao: idPublicacao,
                idUsuario: idUsuario,
                curtida: curtida
            }
        };
        $.post("./SALVAR.php", infos, function(retorno) {
            $('.fa-heart').html(retorno)
        })
    })

    $('.learn-more').on('click', function () {
        const denuncia = $(this).attr('id');
        const idPublicacao = $(this).data('id'); // Use data() to retrieve data-id attribute value
        const idUsuario = $('#id_do_usuario').val(); // Target the input element directly
      
        console.log(denuncia, idPublicacao, idUsuario);
      });
      

    $('.fa-comment-dots').on('click', function (){
        let idPublicacao = $(this).attr('id')
        var idUsuario = $('#id_do_usuario').val();

        // alert(idPublicacao + idUsuario)
      if(idPublicacao !== '' && idUsuario !== ''){
        var comment = {
            idPublicacao: idPublicacao,
            idUsuario: idUsuario
        }
      };
    
        $.get("../../../Controller/publicacaoController.php", comment, function(exibe){
            window.location.href = "../../../Views/siteSerMae/home/publicacao.php?idPub=" + idPublicacao;
        })
    })
});