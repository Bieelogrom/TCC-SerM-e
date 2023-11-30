<?php
include_once("../../../dao/atualizarSessão.php");




?>
<div class="feed">

    <input type="hidden" value="<?= $_SESSION['ID_conta'] ?>" id="id_do_usuario">
    
  


    <!--Feed Top-->
    <?php
    $publicacoes = $publicacaodao->readTodasPublicacoes();

    // Organiza as publicações com base na data (a mais recente primeiro)
    usort($publicacoes, function ($a, $b) {
        $dataA = strtotime($a->getDataPublicacao());
        $dataB = strtotime($b->getDataPublicacao());
        return $dataB - $dataA;
    });


    //Apresentação do INNER JOIN da função readTodasPublicacoes();
    if (count($publicacoes) > 0) {
        foreach ($publicacoes as $publicacao) {
            $id = $publicacao->getIdPublicacao();
            $quantidadeCurtidas = $publicacaodao->contarCurtidas($id)['total_curtidas'];
            $legenda = $publicacao->getLegendaPublicacao();
            $imgPublicacao = $publicacao->getImgPublicacao();
            $dataPublicacao = $publicacao->getDataPublicacao();
            $usuario = $publicacao->getUsuario();
            $fotoPerfil = $usuario->getFotoDePerfil();
            $nomeUsuario = $usuario->getNomeUsuario();


            // Faz a depuração do tempo que a publicação foi colocada no banco e deixa ela bonitinha
            $timestampPublicacao = strtotime($dataPublicacao);
            $tempoDecorrido = time() - $timestampPublicacao;
            if ($tempoDecorrido < 60) {
                $tempoFormatado = $tempoDecorrido . " segundo(s) atrás";
            } elseif ($tempoDecorrido < 3600) {
                $tempoFormatado = round($tempoDecorrido / 60) . " minuto(s) atrás";
            } elseif ($tempoDecorrido < 86400) {
                $tempoFormatado = round($tempoDecorrido / 3600) . " hora(s) atrás";
            } else {
                $tempoFormatado = round($tempoDecorrido / 86400) . " dia(s) atrás";
            }


    ?>

            <div class="feed-top">
                <div class="user">
                    <div class="profile-picture">
                        <a href="../perfilUser/perfil.php?id=<?= $usuario->getIdUsuario() ?>"><img style="height: 100%; width:100%" src="../../../img/siteSerMae/Perfis/<?= $fotoPerfil ?>" alt=""></a>
                    </div>

                    <div class="info">
                        <h3><?= $nomeUsuario ?></h3>
                        <div class="time text-coment">
                            <small id="sw"> Brasil, <span><?php echo $tempoFormatado; ?></span></small>
                        </div>
                    </div>
                </div>
                <!--menu denuncia inicio-->
                <span class="edit">
                    <i class="fas fa-ellipsis" data-modal-target="modal1" id="<?= $id  ?>"></i>
                    <div id="modal1" class="modal">
                        <div class="modal-content">
                            <p class="denunciar" id="openModalButton1" id="denuncia_botton">Denunciar</p>
                            <div id="myModal1" class="modal-desc">
                                <div class="modal-content-desc">
                                    <span class="close-desc" id="closeModalButton1"><i class="fa-solid fa-circle-xmark"></i></span>
                                    <h2>Por que você está denunciando essa publicação?</h2>
                                    <div id="S2"></div>
                                    <div class="opcoes">

                                        <button class="learn-more" type="button" id="Informação falsa" value="<?= $id ?>" data-id="<?= $publicacao->getIdPublicacao(); ?>">
                                            <span class="circle" aria-hidden="true">
                                                <span class="icon arrow"></span>
                                            </span>
                                            <span class="button-text">Informação falsa</span>
                                        </button>

                                        <button class="learn-more" type="button" id="Simplesmente não gostei" value="<?= $id ?>" data-id="<?= $publicacao->getIdPublicacao(); ?>">
                                            <span class="circle" aria-hidden="true">
                                                <span class="icon arrow"></span>
                                            </span>
                                            <span class="button-text">Simplesmente não gostei</span>
                                        </button>

                                        <button class="learn-more" type="button" id="Símbolos ou discurso de ódio" value="<?= $id ?>" data-id="<?= $publicacao->getIdPublicacao(); ?>">
                                            <span class="circle" aria-hidden="true">
                                                <span class="icon arrow"></span>
                                            </span>
                                            <span class="button-text">Símbolos ou discurso de ódio</span>
                                        </button>

                                        <button class="learn-more" type="button" id="Golpe ou fraude" value="<?= $id ?>" data-id="<?= $publicacao->getIdPublicacao(); ?>">
                                            <span class="circle" aria-hidden="true">
                                                <span class="icon arrow"></span>
                                            </span>
                                            <span class="button-text">Golpe ou fraude</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <hr class="linha-denuncia">
                            <h2 class="close" data-modal-close="modal1">Cancelar</h2>
                        </div>
                     </div>
                </span>


                <!--menu denuncia final-->
            </div>

            <!--Feed IMG-->
            <div class="feed-img">
                <?php echo '<img src="../../../img/siteSerMae/publicacao/' . $imgPublicacao . '" alt="Imagem da Publicação" class="publicacao-card"">'; ?>
            </div>

            <!--Feed ação aria-->
            <div class="action-button">
                <div class="interaction-button">
                    <span><i class="fa fa-heart" id="<?= $id ?>"></i></span>
                    <span><?= "<i style='font-size: 18px' class='fa' id='contamento'>" . $quantidadeCurtidas . "</i>"; ?></span>
                    <span><i id="contagem"></i></span>
                    <span><i class="fa fa-comment-dots"  id="<?= $id ?>"></i></span>
                </div>
                <div class="bookmark">
                    <i class="fa fa-bookmark" id="<?= $id ?>"></i>
                </div>
            </div>


            <!--liked by-->
            <div class="liked-by">
                <span><img src="./../../../img/siteSerMae/home/asideBar/eu.png" alt=""></span>
                <span><img src="./../../../img/siteSerMae/home/asideBar/eu.png" alt=""></span>
                <span><img src="./../../../img/siteSerMae/home/asideBar/eu.png" alt=""></span>
                <p><b>Vitória</b> e mais <b>77 comentários</b></p>
            </div>

            <!--caption-->


    <?php
            echo '<div class="caption">';
            echo '<div class="title"><b>' . $legenda . '</b></div>';
            echo '<p> Publicado a ' . $tempoFormatado . '</p>';
            echo '</div><br>';
        }
    } else {
        // Caso não haja publicações a exibir
        echo "Não há publicações a serem exibidas.";
    }


    ?>

    <!--Comentários-->
    <div class="comments text-coment">
        Ver mais comentários
    </div>
    

</div>
</div>



<!--Final do Feed-->