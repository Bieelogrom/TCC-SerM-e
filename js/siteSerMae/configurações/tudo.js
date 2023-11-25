$(document).ready(function() {
    $('.salvar').on('click', function() {
        var id_usuario = $('.IDDOFILHADAPUTA').attr('id');
        var senha_atual = $('#currentPassword').val();
        var nova_senha = $('#newPassword').val();
        var nova_senha_confirmada = $('#confirmPassword').val();
        var alterarSenha = "a";
        
        if(id_usuario !== '' && senha_atual !== '' && nova_senha !== '' && nova_senha_confirmada !== ''){
            var informacoes = {
                id_usuario: id_usuario,
                senha_atual: senha_atual,
                nova_senha: nova_senha,
                nova_senha_confirmada: nova_senha_confirmada,
                alterarSenha: alterarSenha
            }
        }

        $.post('../../../Controller/usuarioController.php', informacoes, function(resposta){
            $('#S2').html(resposta);
            // $('#modal')[0].showModal();
        });
    });
});