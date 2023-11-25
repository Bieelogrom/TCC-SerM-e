<?php

include_once "../dao/conexãoDAO.php";
include_once "../Model/comunidade.php";
include_once "../dao/comunidadeDAO.php";
date_default_timezone_set("America/Sao_Paulo");

$comunidade = new Comunidade();
$comunidadeDao = new ComunidadeDAO();

if (isset($_POST['create_group'])) {
    session_start();
    $id = $_SESSION['ID_conta'];
    $dataAtual = date("Y-m-d H:i:s");
    $nomeComunidade = $_POST['nomeComunidade'];
    $assuntoComunidade = $_POST['assuntoComunidade'];
    $linkComunidade = $_POST['linkComunidade'];

    if (isset($_FILES["imgComunidade"]) && $_FILES["imgComunidade"]["error"] == 0) {
        $diretorioDasFotos = "../img/siteSerMae/comunidade/groups/";
        $nomeDaFoto = uniqid() . "" . $_FILES["imgComunidade"]["name"];

        if (move_uploaded_file($_FILES["imgComunidade"]["tmp_name"], $diretorioDasFotos . $nomeDaFoto)) {
            $caminhoArquivo = $diretorioDasFotos . $nomeDaFoto;

            $comunidade->setDataComunidade($dataAtual);
            $comunidade->setImgComunidade($nomeDaFoto);
            $comunidade->setNomeComunidade($nomeComunidade);
            $comunidade->setAssuntoComunidade($assuntoComunidade);
            $comunidade->setLinkComunidade($linkComunidade);
            $comunidade->setIdUsuario($id);

            $_SESSION['imgComunidade'] = $comunidade->getImgComunidade();

            $comunidadeDao->createComunidade($comunidade);
        }
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha o ID da comunidade da requisição
    $idComunidade = $_POST['idComunidade'];
    $novaSituacao = 2;
    $comunidadeDao = new ComunidadeDAO();
    $resultado = $comunidadeDao->updateSituacaoComunidade($idComunidade, $novaSituacao);

    if ($resultado) {
        echo 'Situação da comunidade alterada com sucesso!';
    } else {
        echo 'Erro ao alterar a situação da comunidade.';
    }
} else {
    // Se o método de requisição não for POST, responda com um erro
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Método não permitido';
}

header("Location: ../Views/siteSerMae/comunidade/index.php");
?>


