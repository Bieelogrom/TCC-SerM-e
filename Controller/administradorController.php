<?php 

include_once "../dao/conexãoDAO.php";
include_once "../Model/administrador.php";
include_once "../Model/usuario.php";

$Administrador = new Administrador();



if(isset($_POST['admin_ação'])){
    $valor = $_POST['opção'];
    $id = $_POST['id_do_user'];

    if($valor == 1){
        $sql = "UPDATE tbUsuario SET statusConta = '1' WHERE idUsuario = '$id'";
        $resultado = conexao::getConexao()->query($sql);
        $resultado->execute();

        header("Location: ../Views/admin/home.php?msg=Atualização_Executada");
        exit();
    }else if($valor == 2){
        $sql = "UPDATE tbUsuario SET statusConta = '2' WHERE idUsuario = '$id'";
        $resultado = conexao::getConexao()->query($sql);
        $resultado->execute();

        header("Location: ../Views/admin/home.php?msg=Atualização_Executada");
        exit();
    }

}else if(isset($_POST['denc'])){

    $user_id = $_POST['id_da_publicacao'];

    try{
        
    $query_user = "SELECT * FROM tbusuario WHERE idUsuario = :id";
    $resultado_user = conexao::getConexao()->prepare($query_user);
    $resultado_user->execute([':id' => $user_id]);
    $row_user = $resultado_user->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($row_user);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

}








?>