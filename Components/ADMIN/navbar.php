<?php
session_start();    
include_once("../../dao/atualizarSessão.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Adm - Dashboard</title>
        <link rel="stylesheet" href="../../css/ADMIN/ADM.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
</html>
    <body>
        <div class="sidebar">

            <div class="logo_content">
                <div class="logo">
                    <img class="img-logo" src="../../img/siteSerMae/boasVindas/serMãe.png" alt="">
                    <div class="logo_name">serMãe</div>
                </div>
                <i class='bx bx-menu' id="btn" ></i>
            </div>


            <ul class="nav_list">
                <li>
                         <i class='bx bx-search' ></i>
                        <input type="text" placeholder="Search..."> 
                </li>

                <li>
                    <a href="../../Views/ADMIN/home.php">
                        <i class="fa-solid fa-house"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashbord</span>
                </li>

                <li>
                    <a href="../../Views/ADMIN/mensagem.php">
                        <i class="fa-solid fa-message"></i>
                        <span class="links_name">Mensagens</span>
                    </a>
                    <span class="tooltip">Mensagens</span>
                </li>

                <li>
                    <a href="../../Views/ADMIN/denuncia.php">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span class="links_name">Denuncias</span>
                    </a>
                    <span class="tooltip">Denuncias</span>
                </li>

                <li>
                    <a href="../../Views/ADMIN/comunidade.php">
                        <i class="fa-solid fa-user-group"></i>
                        <span class="links_name">Comunidades</span>
                    </a>
                    <span class="tooltip">Comunidades</span>
                </li>

                <li>
                    <a href="../../Views/admin/configuracoes.php">
                        <i class="fa-solid fa-gear"></i>
                        <span class="links_name">Configurações</span>
                    </a>
                    <span class="tooltip">Configurações</span>
                </li>
            </ul>


            <div class="profile_content">
                <div class="profile">
                    <div class="profile_details">
                            <img src="../../img/siteSerMae/Perfis/<?= $_SESSION['fotoPerfil'] ?>" alt="Foto ADM">
                        <div class="name_job">
                        <div class="name"><?= $_SESSION['apelido']; ?></div>
                        </div>
                    </div>
                    <a class="log_out" href="../../Dao/logoff.php"><i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            </div>
        </div>

        <br>


        <script>
            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");
            let searchBtn = document.querySelector(".bx-search");

            btn.onclick = function(){
                sidebar.classList.toggle("active");
            }

            searchBtn.onclick = function(){
                sidebar.classList.toggle("active");
            }

        </script>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html> 