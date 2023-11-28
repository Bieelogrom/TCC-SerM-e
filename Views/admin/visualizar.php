<?php

if(isset($_POST["user_id"])){
    include_once('../../dao/conexãoDAO.php');

    $resultado = '';

    $query_user = "SELECT * FROM tbusuario WHERE idUsuario = :id";
    $resultado_user = conexao::getConexao()->prepare($query_user);
    $resultado_user->execute([':id' => $_POST["user_id"]]);
    $row_user = $resultado_user->fetch(PDO::FETCH_ASSOC);


    //incluir estilo css na página onde fica o modal
    $resultado .= '<div class="tudo" style="background-color: #f2f2f2; padding: 10px; border: 1px solid #ccc;">';
$resultado .= '<div class="idUsuaria" style="font-weight: bold;">ID da Usuaria: '.$row_user['idUsuario'].'</div>';
$resultado .= '<div class="nomeUsuaria" style="color: #333;">'.$row_user['nomeUsuario'].'</div>';
$resultado .= '<div class="emailUsuaria" style="color: #555;">'  .$row_user['emailUsuario'].'</div>';
$resultado .= '<div class="sttsEtipos">';
$resultado .= '<div class="statusUsuaria" style="font-style: italic;">Conta: Ativo </div>';
$resultado .= '<div class="tipoUsuaria" style="text-transform: uppercase;">Mae Convencional </div>';
$resultado .=   '</div>'; // Fim Class Status e Tipos


$resultado .=   '</div>';
echo $resultado;


}