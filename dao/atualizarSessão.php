<?php
include_once "conexãoDAO.php";
session_start();

if (!isset($_SESSION['ID_conta'])) {
    header("Location: ../../index.php?acesso=erro");
    exit();
}

try {
    $id = $_SESSION['ID_conta'];

    $sql = "SELECT tbusuario.*, tbTipoPerfil.TipoConta, tbNivelConta.nivelConta, tbstatusconta.statusConta 
        FROM tbusuario 
        INNER JOIN tbTipoPerfil ON tbusuario.tipoConta = tbTipoPerfil.idTipo
        INNER JOIN tbNivelConta ON tbusuario.nivelConta = tbNivelConta.idNivelConta
        INNER JOIN tbstatusconta ON tbusuario.statusConta = tbstatusconta.idstatusConta
        WHERE idUsuario = :id";

    
    $stmt = conexao::getConexao()->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['nomeUsuario'] = $row['nomeUsuario'];
        $_SESSION['email'] = $row['emailUsuario'];
        $_SESSION['senha'] = $row['senhaUsuario'];
        $_SESSION['apelido'] = $row['apelidoUsuario'];
        $_SESSION['fotoPerfil'] = $row['fotoUsuario'];
        $_SESSION['biografiaUsuario'] = $row['bioUsuario'];
        $_SESSION['fotoCapa'] = $row['capaUsuario'];
        $_SESSION['dataNascimento'] = $row['nascUsuario'];
        $_SESSION['telefone'] = $row['telefoneUsuario'];
        $_SESSION['nivelConta'] = $row['nivelConta'];
        $_SESSION['tipoConta'] = $row['TipoConta'];
        
        }
} catch (PDOException $e) {
    echo "Falha na conexão com o banco de dados: " . $e->getMessage();
}
