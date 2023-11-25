<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua Página</title>
    <link rel="stylesheet" href="../../css/siteSerMae/comunidade/index.css">
    <!-- Adicione o link para o FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .group {
            display: flex;
            gap: 50px;
            box-shadow: 0px 10px 8px -3px rgba(0,0,0,0.1),0px 10px 15px -3px rgba(0,0,0,0.1);
            padding: 10px;
            border-radius:20px;
            justify-content: space-between;
        }

        .community-image {
            border-radius: 20px;
            height: 200px;
            width: 200px;
            overflow: hidden;
        }

        .community-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info {
            display: flex;
            justify-content: center;
            flex-direction: column;
            flex-wrap: nowrap;
        }

        .usuario-info {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .profile-picture {
            width: 50px;
            height: 50px;
            overflow: hidden;
            border-radius: 50%;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .icones {
            display: flex;
            gap: 5px;
            flex-direction: column;
            justify-content: center;
        }

        .entrar-btn {
            margin-top: 10px;
            background-color: #a683ff;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s; /* Adiciona uma transição suave */
        }

        .entrar-btn:hover {
            background-color: #7a5cc5; /* Cor mais escura ao passar o mouse */
        }

    </style>
</head>
<body>

<?php
$comunidades = $comunidadeDao->readComunidadesAprovadas(); // Altere para a função correta
foreach ($comunidades as $comunidade) {
    $nomeComunidade = $comunidade->getNomeComunidade();
    $assuntoComunidade = $comunidade->getAssuntoComunidade();
    $dataComunidade = $comunidade->getDataComunidade();
    $linkComunidade = $comunidade->getLinkComunidade();
    $usuario = $comunidade->getUsuario();
    $fotoPerfilCriador = $usuario->getFotoDePerfil();
    $nomeUsuario = $usuario->getNomeUsuario();
    $imgComunidade = $comunidade->getImgComunidade(); // Adicione a função que retorna a foto da comunidade
    $idUsuarioSessao = $_SESSION['ID_conta']; // Supondo que você tenha uma variável de sessão para o ID do usuário

    // Faz a depuração do tempo que a comunidade foi criada e deixa ela bonitinha
    $timestampCriacao = strtotime($dataComunidade);
    $tempoDecorrido = time() - $timestampCriacao;
    if ($tempoDecorrido < 60) {
        $tempoFormatado = $tempoDecorrido . " segundo(s) atrás";
    } elseif ($tempoDecorrido < 3600) {
        $tempoFormatado = round($tempoDecorrido / 60) . " minuto(s) atrás";
    } elseif ($tempoDecorrido < 86400) {
        $tempoFormatado = round($tempoDecorrido / 3600) . " hora(s) atrás";
    } else {
        $tempoFormatado = round($tempoDecorrido / 86400) . " dia(s) atrás";
    }
    ?>
    <div class="group">
        <!-- Imagem da Comunidade -->
        <div class="community-image">
            <img src="../../../img/siteSerMae/comunidade/groups/<?= $imgComunidade ?>" alt="Imagem da Comunidade">
        </div>

        <!-- Informações da Comunidade -->
        <div class="info">

            <h3>Comunidade: <?= $nomeComunidade ?></h3>
            <p>Tema da comunidade: <?= $assuntoComunidade ?></p><br>

            <!-- Informações do usuário -->
            <div class="usuario-info">
                <div class="nome-usuario">
                    <label>Criada por: <?= $nomeUsuario ?></label>
                </div>
                <div class="profile-picture">
                    <img src="../../../img/siteSerMae/Perfis/<?= $fotoPerfilCriador ?>" alt="" class="rounded-image">
                </div>
            </div>

            <small>Criada à <?= $tempoFormatado ?></small>
            <!-- Adiciona label "Criado pela Comunidade" -->

            <!-- Botão Entrar na Comunidade -->
            <a href="<?=$linkComunidade?>" class="entrar-btn">Entrar na Comunidade</a>

            
        </div>
        <!-- Ícones de editar e excluir -->
        <div class="icones">
                <?php if ($usuario->getIdUsuario() == $idUsuarioSessao) { ?>
                    <i class="fas fa-edit"></i> <!-- Ícone de editar -->
                    <i class="fas fa-trash-alt"></i> <!-- Ícone de excluir -->
                <?php } ?>
            </div>
    </div>

<?php
}
?>

</body>
</html>
