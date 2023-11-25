<?php
include_once("../../../dao/atualizarSessão.php");
?>



<div class="modal-corpo-todo">
    <div class="modal-header">
        <h2>Editar o seu Perfil</h2>
        <button id="me-fecha" type="button" onclick="toggleModal()">Voltar</button>
    </div>
    <div class="modal-body">
        <form class="hide">
            <!--dados inicio-->
            <input type="hidden" name="id" value="<?= $_SESSION['ID_conta'] ?? '' ?>" class="id">

            <div class="input-group">
                <h3>Nome Usuária:</h3>
                <input type="text" name="username" id="username" value="<?= $_SESSION['apelido'] ?? '' ?>" class="Apelido" oninput="adicionarArroba(this)">
            </div>


            <!--dropDown-->
            <div class="input-group">
            <h3>Tipo de Perfil:</h3>
                <select name="Tipo_de_perfil" id="Tipo_de_perfil" class="selec">
                    <option value="1">Mãe</option>
                    <option value="2">Gestante</option>
                    <option value="3">Tentante</option>
                    <option value="4">Mãe solo</option>
                    <option value="5">Nenhuma das anteriores</option>                  
                </select>
            </div>

            <div class="input-group">
                <h3 id="resultado"></h3>
            </div>

            <button id="boton" type="button" class="btn btn-primary btn-lg" name="salvar">Salvar Alterações</button>
        </form>
    </div>

</div>