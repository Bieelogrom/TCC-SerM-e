<?php 
include_once("../../../dao/atualizarSessão.php");
include_once "../../../Model/comunidade.php";
include_once "../../../dao/comunidadeDAO.php";
include_once "../../../Model/publicacao.php";
include_once "../../../Dao/publicacaoDAO.php";
include_once "../../../Model/usuario.php";
include_once "../../../Dao/usuarioDAO.php";

$comunidadeDao = new ComunidadeDAO(); // Crie uma instância do ComunidadeDAO

$publicacao = new Publicacao();
$publicacaodao = new PublicacaoDAO();
$usuario = new Usuario();
$usuariodao = new usuarioDAO();

$publicacoes = $publicacaodao->readPublicacao();
$imgPublicacao = $publicacao->getImgPublicacao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/siteSerMae/home/inicioSite.css">
    <link rel="stylesheet" href="../../../css/siteSerMae/comunidade/index.css">
    <link class="img-head" rel="icon" href="../../../img/siteSerMae/bemvinda/serMãe.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Comunidades-serMãe</title>
</head>
<body>
    <!--navBar-->
<?php
    include('../../../components/siteSerMae/navBar.php');   
    ?>
    <!--navBar-->

    <!--Main-->
    <main>
    <div class="container main-container">

    <!--Main left inicio-->
    <div class="main-left">
                    <!--inicio Boas vindas-->
                    <?php
                    include('../../../components/siteSerMae/boasVindas.php')
                    ?>
                    <!--final Boas vindas-->

                    <!--start aside bar-->
                    <?php
                    include('../../../components/siteSerMae/menu.php')
                    ?>
                    <!--end aside bar-->
    </div>
    <!--Main left fim-->


    <!--inicio component listUsuario-->
    <?php
    include('../../../Components/siteSerMae/listUsuario.php')
    ?>
    <!--final component listUsuario-->


    <!--inicio corpo comunidade-->
    <div class="main-comunidade">
        <div class="head-comunidade">
            <div class="add">
                    <h2 class="text-comunidade">Comunidades da serMãe</h2>
                    <input type="submit" class="add-group" value="Criar grupo" id="openModalBtn">
            </div>
        
            
            <div class="modal" id="myModal">
                <div class="modal-content">
                    <!-- Adicione este código dentro do seu modal-content -->
                    <div class="modal-form">
                        <span class="close" id="closeModalBtn">&times;</span>
                        <h2>Seu grupo</h2>
                        <form id="groupForm" enctype="multipart/form-data" action="../../../Controller/comunidadeController.php" method="post"> <!-- Adicione enctype e action -->
                            <div class="group-add-img">
                                <label for="input-file" class="custom-file-upload">
                                    <input type="file" id="input-file" name="imgComunidade" style="display: none;" onchange="previewImage(this);">
                                    <img class="img-group" src="../../../img/siteSerMae/comunidade/groups/1.png" id="profile-pic">
                                </label>
                            </div>

                            <div class="dados-group">
                                <label for="groupName">Nome do Grupo:</label>
                                <input type="text" id="groupName" name="nomeComunidade" required>

                                <label for="groupSubject">Assunto do grupo:</label>
                                <select id="groupSubject" name="assuntoComunidade" required>
                                    <option value="Saúde mental">Saúde mental</option>
                                    <option value="Saúde física">Saúde física</option>
                                    <option value="Maternidade">Maternidade</option>
                                    <option value="Filhos (criação)">Filhos (criação)</option> <!-- Corrigido o valor da opção -->
                                    <!-- Adicione mais opções conforme necessário -->
                                </select>

                                <label for="groupLink">Link telegram:</label>
                                <input type="text" id="groupLink" name="linkComunidade" required> <!-- Alterado para linkComunidade -->
                            </div>

                            <button type="submit" class="create-group-btn" name="create_group">Criar Grupo</button> <!-- Alterado para create_group -->
                        </form>
                    </div>
                </div>
            </div>



                
        </div>

        <!--inicio grupos-->
        <div class="listGroups">
        <?php
        include('../../../components/siteSerMae/listGroups.php')
        ?>
        </div>
        <!--final grupos-->

    </div>
    <!--final corpo comunidade-->


    </div>
</main>


    <!--Inicio popup aria-->
    <!--final perfil-popUp-->
    <?php
    include('../../../components/siteSerMae/perfilPopup.php')
    ?>
    <!--inicio perfil-popUp-->

    <!--inicio adicionar post-->
    <?php
    include('../../../components/siteSerMae/adicionarPost.php')
    ?>
    <!--final adicionar post-->
    <!--Final popup aria-->




<!--inicio modal-->
<script>
var openModalBtn = document.getElementById('openModalBtn');
var modal = document.getElementById('myModal');
var closeModalBtn = document.getElementById('closeModalBtn');

openModalBtn.onclick = function() {
    modal.style.display = 'block';
}

closeModalBtn.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
<!--final modal-->

<script>
 function previewImage(input) {
    var file = input.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('profile-pic').src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
}
</script>

<!--inicio dropDown-->
<script>
    // Função para preencher dinamicamente as opções do dropdown
    function populateDropdown() {
        var dropdown = document.getElementById("groupSubject");
        // Array de opções
        var options = ["Opção 1", "Opção 2", "Opção 3", "Outra Opção"];

    }

    // Chamar a função ao carregar a página
    window.onload = populateDropdown;
</script>

<!--final dropDown-->
</body>
</html>