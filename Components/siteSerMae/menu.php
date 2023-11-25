

 <!--start aside bar-->
 <aside class="corpo-menu">
    <a class="menu-item active" href="./../../../Views/siteSerMae/home/home.php">
        <span><i class="fa-solid fa-house"></i></span>
        <h3>Inicío</h3>
    </a>

    <a class="menu-item" id="messageMenu"  href="./../../../Views/siteSerMae/perfilUser/perfil.php">
        <span><i class="fa-solid fa-user"></i></span>
        <h3>Perfil</h3>
    </a>

    <a class="menu-item" id="Notify-box" href="./../../../Views/siteSerMae/notificacoes/index.php">
        <span><i class="fa-sharp fa-solid fa-bell"></i></span>
        <h3>Notificações</h3>
    </a>

    <a class="menu-item" id="Notify-box" href="./../../../Views/siteSerMae/comunidade/index.php">
        <span><i class="fa-solid fa-user-group"></i></span>
        <h3>Comunidades</h3>
    </a>

    <a class="menu-item" id="theme" href="./../../../Views/siteSerMae/telaDicas/dicas.php">
        <span><i class="fa-solid fa-heart"></i></span>
        <h3>Dicas</h3>
    </a>

    <a class="menu-item" id="theme" href="./../../../Views/siteSerMae/configuracoes/index.php">
        <span><i class="fa-solid fa-gear"></i></span>
        <h3>Configurações</h3>
    </a>



</aside><br>    



<?php
if (isset($_SESSION['nivelConta']) && $_SESSION['nivelConta'] == 3) { ?>
    <button onclick="admin()" class="btn-adm">Tela ADMIN</button>
<?php }
?>
<div id="fade" class="hide"></div>

  

<!--end aside bar-->