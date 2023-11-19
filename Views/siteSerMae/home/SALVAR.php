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
}
?>
