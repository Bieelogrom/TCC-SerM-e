<?php

if(isset($_POST["user_id"])){
    include_once('../../dao/conexãoDAO.php');

    $resultado = '';

    $query_user = "SELECT * FROM tbusuario WHERE idUsuario = :id";
    $resultado_user = conexao::getConexao()->prepare($query_user);
    $resultado_user->execute([':id' => $_POST["user_id"]]);
    $row_user = $resultado_user->fetch(PDO::FETCH_ASSOC);


    //incluir estilo css na página onde fica o modal
    $resultado .= '<div class="tudo">';
    
    $resultado .= '<div class="idUsuaria">ID da Usuaria: '.$row_user['idUsuario'].'</div>';

    $resultado .= '<div class="nomeUsuaria">'.$row_user['nomeUsuario'].'</div>';

    $resultado .= '<div class="emailUsuaria">' .$row_user['emailUsuario'].'</div>';


    $resultado .= '<div class="sttsEtipos">';

        $resultado .= '<div class="statusUsuaria">Conta: Ativo </div>';

        $resultado .= '<div class="tipoUsuaria">Mae Convencional </div>';

    $resultado .= '</div>';// Fim Class Status e Tipos


    $resultado .= '<div class="dropdown"> 
        <select id="situacao" name="opção">
            <option value="2">Suspenso</option>
            <option value="1">Ativo</option>
            <option value="3">Tornar Adm</option>
        </select>
        </div>';

    $resultado .= '<div class="btnSalvar">
                      <button> Salvar </button> 
                   </div>';

    $resultado .= '</div>';

    echo $resultado;

}