<?php
if(isset($_POST["idPublicacao"], $_POST['idUsuario'], $_POST['acao'])){
    include_once('../../../dao/conexãoDAO.php');

    $idPublicacao = $_POST['idPublicacao'];
    $idUsuario = $_POST['idUsuario'];
    $acao = $_POST['acao'];

    if ($acao === 'salvar') {
        // Verificar se a publicação já está salva para o usuário
        $query_verificar = "SELECT COUNT(*) AS total FROM tbsalvos WHERE idPublicacao = ? AND idUsuario = ?";
        $resultado_verificar = conexao::getConexao()->prepare($query_verificar);
        $resultado_verificar->execute([$idPublicacao, $idUsuario]);
        $total = $resultado_verificar->fetchColumn();

        if ($total == 0) {
            // A publicação ainda não está salva, então podemos inseri-la na tabela
            $query_pub = "INSERT INTO tbsalvos (idPublicacao, idUsuario) VALUES (?, ?)";
            $resultado_publicacao = conexao::getConexao()->prepare($query_pub);
            $resultado_publicacao->execute([$idPublicacao, $idUsuario]);
            // Retornar alguma resposta para o front-end, se necessário
         
        } else {
            // A publicação já está salva, então não é necessário fazer nada
      
        }
    } elseif ($acao === 'remover') {
        // Remover a publicação da tabela de salvos
        $query_remover = "DELETE FROM tbsalvos WHERE idPublicacao = ? AND idUsuario = ?";
        $resultado_remover = conexao::getConexao()->prepare($query_remover);
        $resultado_remover->execute([$idPublicacao, $idUsuario]);
        // Retornar alguma resposta para o front-end, se necessário
  
    } else {
        // Ação inválida

    }
}else if(isset($_POST["acao"])){
    include_once('../../../dao/conexãoDAO.php');

    $curtida = $_POST['curtida'];
    $idUsuario = $_POST['idUsuario'];
    $idPublicacao = $_POST['idPublicacao'];
    $dataAtual = date("Y-m-d H:i:s");

    // echo $curtida . $idUsuario . $idPublicacao . $dataAtual;

    
    try{
        $curtimento = "INSERT INTO tbcurtidas (idUsuario, idPublicacao, dataCurtida) VALUES (:idUsuario, :idPublicacao, :dataAtual)";
        $resultado = conexao::getConexao()->prepare($curtimento);
        $resultado->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $resultado->bindParam(':idPublicacao', $idPublicacao, PDO::PARAM_INT);
        $resultado->bindParam(':dataAtual', $dataAtual);
        $resultado->execute();

        echo "certo";

    }catch(PDOException $e){
        echo $e->getMessage();
    }



}
?>
