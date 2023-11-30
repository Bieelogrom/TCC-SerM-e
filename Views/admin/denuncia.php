<?php
include_once('../../components/ADMIN/navbar.php');
include_once('../../components/ADMIN/navbar/navSuperior.php');
include_once("../../dao/usuarioDAO.php");
include_once("../../model/usuario.php");
include_once("../../dao/atualizarSessão.php");
$usuarioDAO = new usuarioDAO();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncia</title>
    <link class="img-head" rel="icon" href="../../../img/siteSerMae/bemvinda/serMãe.png">

    <link rel="stylesheet" href="../../css/ADMIN/denuncia.css">

    <link rel="stylesheet" href="../../components/ADMIN/navbar/navSuperior.css">
    <!-- CSS Navbar -->
    <link rel="stylesheet" href="../../components/ADMIN/style.css">
    <!-- Imports -->
    <!-- BoxIcons CDN links -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <section class="home-section">
        <div class="conteudo-adm">
            <h2>Denúncias</h2>
            <div class="tabelaDenuncias">
                <table> 
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Denunciador</th>
                            <th>Post denunciado</th>
                            <th>Tipo de denuncia</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <?php foreach($usuarioDAO->verificarDenuncias() as $denuncias) : ?>
                    <tbody>
                        <tr>
                            <td class="idDoUser" id="<?= $denuncias->getIdUsuario() ?>"><?= $denuncias->getIdUsuario() ?></td>
                            <td><?= $denuncias->getNomeUsuario() ?></td>
                            <td><a href="../siteSerMae/home/publicacao.php?idPub=<?= $denuncias->getTipoDePerfil() ?>"><?= $denuncias->getSenhaUsuario() ?></a></td>
                            <td><?= $denuncias->getStatusConta() ?></td>
                            <td><?= $denuncias->getDataNascimentoUsuario() ?></td>
                            <td class="iconsTable">
                            <button class='bx bxs-check-circle' id="<?= $denuncias->getIdUsuario() ?>"></button>
                            <i class='bx bx-trash'></i>
                            </td>
                        </tr>
                    </tbody>
                    <?php endforeach ?>
                </table>
            </div><!-- Fim Tabela Denuncias -->
        </div><!-- Fim Conteudo Adm-->
        
        <!-- Modal Denuncia -->
        <div id="fadeDenuncia" class="hide"></div>
            <div id="modalDenuncia" class="hide">
                <div id="modalHeaderDenuncia">
                    <h3>ID Denuncia: 
                        <p class="idUser">
                        </p>
                    </h3>
                    <button id="fecharModalDenuncia">&times;</button>
                </div><!-- Fim Modal Header -->

                <div id="modalBodyDenuncia">
                    <div class="denuncia">
                        <div class="denunciador">
                            <h2>Denunciador</h2>
                            <div class="fotoDenunciador">
                                <img src="../../img/ADMIN/perfil.png" alt="">
                            </div><!-- Fim FotoDenunciador -->
                            <div class="nomeDenunciador">
                                <p class="nome_denunciador"></p>
                            </div><!-- Fim NomeDenunciador -->
                            <div class="emailDenunciador">
                                <p class="email_denunciardor"></p>
                            </div><!-- Fim EmailDenunciador -->
                        </div><!-- Fim Denunciador -->
                        
                        <div class="denunciado">
                            <h2>Denunciado</h2>
                            <div class="fotoDenunciado">
                                <img src="../../img/ADMIN/perfil.png" alt="">
                            </div><!-- Fim FotoDenunciador -->
                            <div class="nomeDenunciado">
                                <p>Guilherme</p>
                            </div><!-- Fim NomeDenunciador -->
                            <div class="emailDenunciado">
                                <p>Guilherme@gmail.com</p>
                            </div><!-- Fim EmailDenunciador -->

                            <!-- Modal Aninhado -->

                            <div id="fadeChild" class="hide"></div>
                                <div id="modalAninhadoDenuncia" class="hide">
                                <div class="modalContentAninhado">
                                    <button class="close" id="closeModalBtn">&times;</button>
                                        <div class="motivo">
                                            <label>Motivo</label>
                                            <textarea name="motivo" id="motivo"></textarea>
                                        </div><!-- Fim Motivo -->

                                        <div class="acaoDenuncia">
                                            <div class="tempoSuspenso">
                                                <select name="" id="">
                                                    <option value="#">24 Horas</option>
                                                    <option value="#">1 Semana</option>
                                                    <option value="#">1 Mês</option>
                                                    <option value="#">Permanentemente</option>
                                                </select>
                                            </div><!-- Fim TempoSuspenso -->
                                            <div class="btnSuspender">
                                                <button>Suspender</button>
                                            </div><!-- FIm btnSuspender -->
                                        </div><!-- Fim AçãoDenuncia -->
                              </div><!-- Fim ModalContentAninhado -->
                            </div><!-- fim Modal Aninhado -->
                        </div>
                    </div><!-- Fim Denuncia -->
                    <button id="openChildModal">Pegar Denuncia</button>

                </div><!-- Fim Modal Body -->
            </div><!-- Fim Modal Denuncia -->

        <!-- Modal Excluir -->
            <div id="fade" class="hide"></div>
            <div id="modal" class="hide">
                <div id="modal-header">
                    <h3>ID Denuncia: 
                        <p class="idUser">
                            1
                        </p>
                    </h3>
                    <button id="fechar-modal">x</button>
                </div><!-- Fim Modal Header -->

                <div id="modal-body">
                    <h4>Deseja realmente excluir a denuncia?</h4>
                    <div class="actionLinks">
                        <div class="links">
                            <a href="#" class="nao">Não</a>
                            <a href="#" class="sim">Sim</a>
                        </div>
                        
                    </div>
                </div><!-- Fim Modal Body -->
            </div><!-- Fim Modal Excluir -->
    </section>

    
            <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
            <script src="../../Components/ADMIN/menu-lateral.js"></script>
            <script src="../../Components/ADMIN/modal/modalDenunciaConfig.js"></script>
            
</body>
</html>