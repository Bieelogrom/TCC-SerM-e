<?php

include_once "../dao/conexãoDAO.php";
include_once "../Model/usuario.php";
include_once "../dao/usuarioDAO.php";

$usuario = new Usuario();
$usuariodao = new usuarioDAO();

$d = filter_input_array(INPUT_POST);

if (isset($_POST['registrar'])) {

    $email = $d['email'];

    $usuario->setNomeUsuario($d['nome'] . ' ' . $d['sobrenome']);
    $usuario->setTelefoneUsuario($d['phone']);
    $usuario->setEmailUsuario($d['email']);
    $usuario->setDataNascimentoUsuario($d['dataNasc']);

    $palavras = array("MomLife", "MommyWarrior", "MommaMagic", "MamaVibe", "MomStrong", "TenderHeart");
    $apelido = "@" . $palavras[array_rand($palavras)] . rand(10, 100);

    $usuario->setApelidoUsuario($apelido);

    $sql = "SELECT emailUsuario FROM tbusuario WHERE emailUsuario = '$email'";
    $resultado = conexao::getConexao()->query($sql);
    $stmt = $resultado->fetch(PDO::FETCH_ASSOC);

    if ($resultado->rowCount() == 1) {
        header('Location: ../index.php?cadastro=erro');
    } else {
        if ($d['password'] == $d['confirmPassword']) {
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $usuario->setSenhaUsuario($hash);

            $usuariodao->createUsuario($usuario);
            $id = conexao::getConexao()->lastInsertId();

            session_start();

            $_SESSION['ID_conta'] = $id;
            $_SESSION['nomeUsuario'] = $usuario->getNomeUsuario();

            header('Location: ../Views/siteSerMae/loginCadastro/adicionarFoto.php');
        } else {
            header('Location: /index.php?login=erro');
        }
    }
} else if (isset($_POST['login'])) {
    session_start();

    $email = filter_input(INPUT_POST, 'loginEmail', FILTER_SANITIZE_EMAIL);
    $senha = trim(($_POST['loginSenha']));


    try {
        $sql = "SELECT * FROM tbusuario WHERE emailUsuario = '$email'";

        $resultado = conexao::getConexao()->query($sql);
        $logado = $resultado->fetchAll();
        $n = count($logado);


        if ($n == 1) {
            if ($logado[0]['statusConta'] == 1) {

                $id =  $logado[0]['idUsuario'];
                $hash = $logado[0]['senhaUsuario'];
                $email = $logado[0]['emailUsuario'];

                $stmt = conexao::getConexao()->prepare($sql);
                $stmt->bindParam("s", $email);

                $stmt->bindValue($id, $hash);
                $stmt->fetch();

                if (password_verify($senha, $hash)) {
                    $_SESSION['ID_conta'] = $logado[0]['idUsuario'];
                    $_SESSION['Usuarioautenticado'] = 'SIM';

                    header('Location: ../Views/siteSerMae/home/home.php');
                    exit();
                } else {
                    header('Location: ../index.php?login=erro');
                    exit();
                } //outros status abaixo
            } else if ($logado[0]['statusConta'] == 2) {
                header('Location: ../index.php?login=suspenso');
                exit();
            } else {
                header('Location: ../index.php?login=banido');
                exit();
            }
        } else {
            header('Location: ../index.php?login=erro');
            exit();
        }
    } catch (PDOException $e) {
        echo "ERRO: " . $e->getMessage();
    }
} else if (isset($_POST['atualizaPerfil'])) {
    session_start();

    $id = $_SESSION['ID_conta'];


    if (isset($_FILES["fotoUsuario"]) && $_FILES["fotoUsuario"]["error"] == 0) {

        $diretoriodasfotos = "../img/siteSerMae/Perfis/";

        $nomeDaFoto = $_FILES["fotoUsuario"]["name"];

        if (move_uploaded_file($_FILES["fotoUsuario"]["tmp_name"], $diretoriodasfotos . $nomeDaFoto)) {

            $caminho_arquivo = $diretoriodasfotos . $nomeDaFoto;

            $usuario->setfotoDePerfil($nomeDaFoto);

            $_SESSION['fotoUsuario'] = $usuario->getFotoDePerfil();

            header("Location: ../Views/siteSerMae/home/boasVindas.php");

            $usuariodao->informacoesAdicionais($usuario);
        }
    }
} else if (isset($_POST['tipoDePerfil'])) {
    session_start();

    $id = $_SESSION['ID_conta'];

    $usuario->setTipoDePerfil($d['tipoPerfil']);

    header("Location: ../Views/siteSerMae/home/home.php");



    $usuariodao->tipoDaConta($usuario);
} else if (isset($_POST['salvarDados'])) {
    $idUsuario = $_POST['id'];
    $apelido = $_POST['apelido'];
    $tipoPerfil = $_POST['tipo'];
    $bio = $_POST['biografia'];

    try {
        $sql = "UPDATE tbusuario SET apelidoUsuario = :apelido, tipoConta = :tipoConta, bioUsuario = :biografia WHERE idUsuario = :idUsuario";
        $att = conexao::getConexao()->prepare($sql);
        $att->bindParam(':apelido', $apelido);
        $att->bindParam(':tipoConta', $tipoPerfil);
        $att->bindParam(':biografia', $bio);
        $att->bindParam(':idUsuario', $idUsuario);
        $att->execute();

        echo 'Atualizado com sucesso!';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}else if(isset($_POST['alterarSenha'])){
    $id_usuario = $_POST['id_usuario'];
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $nova_senha_confirmada = $_POST['nova_senha_confirmada'];

    try{
        //verifica senha do banco
        $verifica_senha_atual = "SELECT senhaUsuario FROM tbusuario WHERE idUsuario = :idUsuario";
        $faz_busca = conexao::getConexao()->prepare($verifica_senha_atual);
        $faz_busca->bindParam(':idUsuario', $id_usuario, PDO::PARAM_INT);
        $faz_busca->execute();
        $resultado_da_busca = $faz_busca->fetch(PDO::FETCH_ASSOC);

        $senha_antiga_criptografada = $resultado_da_busca['senhaUsuario'];



        if(password_verify($senha_atual, $senha_antiga_criptografada)){
           if($nova_senha == $nova_senha_confirmada){
            $hash_da_senha_nova = password_hash($nova_senha_confirmada, PASSWORD_DEFAULT);

            $atualiza_senha = "UPDATE tbusuario SET senhaUsuario = :novaSenha WHERE idUsuario = :idUsuario";
            $atualizar = conexao::getConexao()->prepare($atualiza_senha);
            $atualizar->bindParam(':novaSenha', $hash_da_senha_nova);
            $atualizar->bindParam(':idUsuario', $id_usuario);
            $atualizar->execute();

            echo "SENHA ATUALIZADA COM SUCESSO!";


           }else{
            echo "As senhas não coicidem!";
           }
        }else{
            echo "A senha atual não bate!";
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }

    
}else if(isset($_POST['alterarfotos'])){
    // função para alterar foto;
    session_start();

    $foto = $_POST['fotoUsuario'];
    $id = $_SESSION['ID_conta'];

    if (isset($_FILES["fotoUsuario"]) && $_FILES["fotoUsuario"]["error"] == 0) {

    $diretoriodasfotos = "../img/siteSerMae/Perfis/";

    $nomeDaFoto = $_FILES["fotoUsuario"]["name"];

        if (move_uploaded_file($_FILES["fotoUsuario"]["tmp_name"], $diretoriodasfotos . $nomeDaFoto)) {

            $caminho_arquivo = $diretoriodasfotos . $nomeDaFoto;

            $usuariodao->alterarFoto($nomeDaFoto, $id);

            header("Location: ../Views/siteSerMae/perfilUser/perfil.php");
        }
    }
}
