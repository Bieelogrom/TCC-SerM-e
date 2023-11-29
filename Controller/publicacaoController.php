<?php

include_once "../dao/conexãoDAO.php";
include_once "../Model/publicacao.php";
include_once "../dao/publicacaoDAO.php";
date_default_timezone_set("America/Sao_Paulo");

$publicacao = new Publicacao();
$publicacaodao = new PublicacaoDAO();

if (isset($_POST['admin_ação'])) {
    session_start();
    $id = $_SESSION['ID_conta'];
    $dataAtual = date("Y-m-d H:i:s");
    $legenda = $_POST['legenda'];
    

    if (isset($_FILES["imagemPost"]) && $_FILES["imagemPost"]["error"] == 0) {
        $diretoriodasfotos = "../img/siteSerMae/publicacao/";
        $nomeDaFoto = uniqid() . "" . $_FILES["imagemPost"]["name"];

        if (move_uploaded_file($_FILES["imagemPost"]["tmp_name"], $diretoriodasfotos . $nomeDaFoto)) {
            $caminho_arquivo = $diretoriodasfotos . $nomeDaFoto;

            $publicacao->setDataPublicacao($dataAtual);
            $publicacao->setImgPublicacao($nomeDaFoto);
            $publicacao->setLegendaPublicacao($legenda);
            $publicacao->setIdUser($id);
            
            echo $id;

            $_SESSION['imagemPost'] = $publicacao->getImgPublicacao();

            $publicacaodao->createPublicacao($publicacao);
        }
    }
    header("Location: ../Views/siteSerMae/home/home.php");
}else if(isset($_POST['comentarNoPost'])){
    $idU = $_POST['idUsuario'];
    $idP = $_POST['idPublicacao'];
    $C = $_POST['comentario'];
    $set = $_POST['comentarNoPost'];




    try {
        $sql = "INSERT INTO tbcomentarios (comentario, idUsuario, idPublicacao) VALUES (:comentario, :idUsuario, :idPublicacao)";
        $insertion = conexao::getConexao()->prepare($sql);
        $insertion->bindParam(':comentario', $C, PDO::PARAM_STR);
        $insertion->bindParam(':idUsuario', $idU, PDO::PARAM_INT);
        $insertion->bindParam(':idPublicacao', $idP, PDO::PARAM_INT); 
        $insertion->execute();
    
        echo 'certo';
    
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    

}else if(isset($_POST['denunciar'])){
    $idPublicacao = $_POST['idPublicacao'];
    $idUsuario =  $_POST['idUsuario'];
    $denuncia =  $_POST['denuncia'];
    $dataAtual = date("Y-m-d H:i:s");

    // echo $idPublicacao . $idUsuario . $denuncia;

    try{
        $sql = "INSERT INTO tbdenuncias (tipoDenuncia, idUsuario, idPublicacao, dataDenuncia) VALUES (:denuncia, :idUsuario, :idPublicacao, :dataDenuncia)";
        $enviar = conexao::getConexao()->prepare($sql);
        $enviar->bindParam(':denuncia', $denuncia);
        $enviar->bindParam(':idUsuario', $idUsuario);
        $enviar->bindParam(':idPublicacao', $idPublicacao);
        $enviar->bindParam(':dataDenuncia', $dataAtual);
        $enviar->execute();

        echo "CERTO";

    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
