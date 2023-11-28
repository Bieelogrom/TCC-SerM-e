

$(document).ready(function() {
    $(document).on('click', '.fa-bookmark', function() {
        var idPublicacao = $(this).attr("id");
        var idUsuario = $('#id_do_usuario').val();
        var itemSalvo = $(this).hasClass('salvo');
        var salvar_postagem = "s"
        // console.log("ID do usuario = "+ idUsuario)
        // console.log("ID da publicação = "+ idPublicacao)
        if (idPublicacao !== '' && idUsuario !== '') {
            var dados = {
                idPublicacao: idPublicacao,
                idUsuario: idUsuario,
                acao: itemSalvo ? 'remover' : 'salvar',
                salvar_postagem: salvar_postagem
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

    $('.fa-heart').on('click', function() {
        var idPublicacao = $(this).attr("id");
        var curtida = 0;
        var idUsuario = $('#id_do_usuario').val();
        var itemCurtido = $(this).hasClass('salvo');
        var acao = "1"

        // alert(idPublicacao + idUsuario)
        if (curtida !== '' && idPublicacao !== '' && idUsuario !== '') {
            var infos = {
                idPublicacao: idPublicacao,
                idUsuario: idUsuario,
                curtida: curtida,
                acao: acao,
                opcaos: itemCurtido ? 'remover' : 'salvar',
            }
        };
        
        $.post("./SALVAR.php", infos, function(retorno) {
            if (itemCurtido) {
                $('.fa-heart').removeClass('salvo');
            } else {
                $('.fa-heart').addClass('salvo');
            }
            $('#contamento').html(retorno)
        })
    })

    $('.fa-ellipsis').on('click', function () {
        var idPublicacao = $(this).attr("id");
        var idUsuario = $('#id_do_usuario').val();
    
        // Verifica se idPublicacao, idUsuario e outros valores necessários estão presentes
        if (idPublicacao !== "" && idUsuario !== "") {
            $('.learn-more').on('click', function () {
                var denuncia = $(this).attr('id');
                var denunciar = "denunc";
    
                var botafogo = {
                    idPublicacao: idPublicacao,
                    idUsuario: idUsuario,
                    denuncia: denuncia,
                    denunciar: denunciar
                };
    
                $.post("../../../Controller/publicacaoController.php", botafogo, function (lorota) {
                    // $('#S2').html(lorota);
                    location.reload();
                });
            });
        }
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


    $('.btn-submitar').on('click', function (){
        let idPublicacao = $(this).attr('id');
        let comentario = $('#add-post').val();
        var idUsuario = $('#id_do_usuario').val();
        var comentarNoPost = 'b';

        // alert(idPublicacao + idUsuario + comentario + comentarNoPost)

        if(idPublicacao !== '' && idUsuario !== '' && comentario !== ''){
            var criarComentario = {
                idPublicacao: idPublicacao,
                comentario: comentario,
                idUsuario: idUsuario,
                comentarNoPost: comentarNoPost
            }
        };

        $.post("../../../Controller/publicacaoController.php", criarComentario, function(pora){
            $('h1#rs').html(pora)
        })


    })
});