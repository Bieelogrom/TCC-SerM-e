<?php
include('../../components/ADMIN/navbar.php');
include('../../components/ADMIN/navbar/navSuperior.php');

include_once "../../dao/conexãoDAO.php";
include_once "../../Model/comunidade.php";
include_once "../../dao/comunidadeDAO.php";
include_once "../../Model/usuario.php";

$comunidadeDao = new ComunidadeDAO();
$comunidades = $comunidadeDao->readComunidadesEmEspera();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../Controller/comunidadeController.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncia</title>

    <link rel="stylesheet" href="../../css/ADMIN/denuncia.css">
    <link class="img-head" rel="icon" href="../../../img/siteSerMae/bemvinda/serMãe.png">

    <link rel="stylesheet" href="../../components/ADMIN/navbar/navSuperior.css">
    <!-- CSS Navbar -->
    <link rel="stylesheet" href="../../components/ADMIN/style.css">
    <!-- Imports -->
    <!-- BoxIcons CDN links -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="...">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5aRqF5fFiaNqFkg/6S8Xz6ZQeznR/6Z9ifUfEea13KIjowL" crossorigin="anonymous">

    <style>
        /* Adicione isso ao seu arquivo denuncia.css ou ao local apropriado onde você gerencia os estilos */

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        #modalHeaderAprovarComunidade {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        #modalTitle {
            margin: 0;
        }

        #fecharModalAprovarComunidade {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 20px;
            color: #888;
        }

        #modalBodyAprovarComunidade {
            text-align: center;
        }

        #btnSim,
        #btnNao {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        #btnNao {
            background-color: #f44336;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <section class="home-section">
        <div class="conteudo-adm">
            <h2>Comunidades em espera...</h2>
            <div class="tabelaDenuncias">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome Comunidade</th>
                            <th>Assunto da Comunidade</th>
                            <th>Nome do Usuario que criou</th>
                            <th>Data</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($comunidades as $comunidade) { ?>
                            <tr>
                                <td><?php echo $comunidade->getIdComunidade(); ?></td>
                                <td><?php echo $comunidade->getNomeComunidade(); ?></td>
                                <td><?php echo $comunidade->getAssuntoComunidade(); ?></td>
                                <td><?php echo $comunidade->getUsuario()->getNomeUsuario(); ?></td>
                                <td><?php echo $comunidade->getDataComunidade(); ?></td>
                                <td class="iconsTable">
                                    <i class='bx bxs-check-circle' onclick="abrirModal('<?php echo $comunidade->getIdComunidade(); ?>', 'aprovarComunidade')"></i>
                                    <i class='bx bx-trash' onclick="confirmarExclusao('<?php echo $comunidade->getIdComunidade(); ?>', 'excluirComunidade')"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>






        <!-- Modal Aprovar Comunidade -->
        <div id="modalAprovarComunidade" class="modal hide">
            <div id="modalHeaderAprovarComunidade">
                <h3 id="modalTitle">Deseja aprovar esta comunidade?</h3>
                <button id="fecharModalAprovarComunidade" onclick="fecharModal('modalAprovarComunidade')">&times;</button>
            </div>
            <div id="modalBodyAprovarComunidade">
                <div class="acaoDenuncia">
                <!-- Adicione campos ocultos para indicar as ações -->
                    <input type="hidden" name="acao" value="aprovarComunidade">
                    <input type="hidden" name="idComunidade" value="<?php echo $comunidade->getIdComunidade(); ?>">

                    <button id="btnSim" onclick="acaoSim()">Sim</button>
                    <button id="btnNao" onclick="acaoNao()">Não</button>
                </div>
            </div>
        </div>








        <!-- Modal Confirmar Exclusão -->
        <div id="modalExcluirComunidade" class="modal hide">
            <div id="modalHeaderExcluirComunidade">
                <h3 id="modalTitleExcluir">Deseja excluir esta comunidade?</h3>
                <button id="fecharModalExcluirComunidade" onclick="fecharModal('modalExcluirComunidade')">&times;</button>
            </div>
            <div id="modalBodyExcluirComunidade">
                <div class="acaoDenuncia">
                    <button id="btnConfirmarExclusao" onclick="confirmarExclusao()">Sim</button>
                    <button id="btnCancelarExclusao" onclick="fecharModal('modalExcluirComunidade')">Não</button>
                </div>
            </div>
        </div>


    </section>

    <script src="../../Components/ADMIN/menu-lateral.js"></script>
    <script>
        function confirmarExclusao(idComunidade) {
            const modal = document.getElementById('modalExcluirComunidade');
            const modalTitle = document.getElementById('modalTitleExcluir');
            const btnConfirmar = document.getElementById('btnConfirmarExclusao');

            modalTitle.innerText = `Deseja excluir a Comunidade ID ${idComunidade}?`;

            btnConfirmar.onclick = function () {
                excluirComunidade(idComunidade);
                modal.style.display = 'none';
            };

            modal.style.display = 'block';
        }

        function excluirComunidade(idComunidade) {
            fetch('../../Controller/publicacaoController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `idComunidade=${idComunidade}`,
            })
                .then(response => response.text())
                .then(data => {
                    console.log('Resposta do servidor:', data);
                    const avisoDiv = document.createElement('div');
                    avisoDiv.innerHTML = '<p>A comunidade foi excluída!</p>';
                    avisoDiv.style.position = 'fixed';
                    avisoDiv.style.top = '50%';
                    avisoDiv.style.left = '50%';
                    avisoDiv.style.transform = 'translate(-50%, -50%)';
                    avisoDiv.style.backgroundColor = '#f44336';
                    avisoDiv.style.color = 'white';
                    avisoDiv.style.padding = '20px';
                    avisoDiv.style.borderRadius = '10px';

                    document.body.appendChild(avisoDiv);

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        }






        function abrirModal(idComunidade) {
            const modal = document.getElementById('modalAprovarComunidade');
            const modalTitle = document.getElementById('modalTitle');
            const btnSim = document.getElementById('btnSim');
            const btnNao = document.getElementById('btnNao');

            modalTitle.innerText = `Deseja aprovar a Comunidade ID ${idComunidade}?`;

            btnSim.onclick = function () {
                const refreshIcon = document.createElement('i');
                refreshIcon.className = 'fa fa-refresh fa-spin';
                refreshIcon.style.position = 'fixed';
                refreshIcon.style.top = '50%';
                refreshIcon.style.left = '50%';
                refreshIcon.style.transform = 'translate(-50%, -50%)';
                document.body.appendChild(refreshIcon);

                setTimeout(() => {
                    document.body.removeChild(refreshIcon);

                    const avisoDiv = document.createElement('div');
                    avisoDiv.innerHTML = '<p>A comunidade foi aprovada!</p>';
                    avisoDiv.style.position = 'fixed';
                    avisoDiv.style.top = '50%';
                    avisoDiv.style.left = '50%';
                    avisoDiv.style.transform = 'translate(-50%, -50%)';
                    avisoDiv.style.backgroundColor = '#4CAF50';
                    avisoDiv.style.color = 'white';
                    avisoDiv.style.padding = '20px';
                    avisoDiv.style.borderRadius = '10px';

                    document.body.appendChild(avisoDiv);

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }, 2000);

                fetch('../../Controller/comunidadeController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `idComunidade=${idComunidade}`,
                })
                    .then(response => response.text())
                    .catch(error => {
                        console.error('Erro:', error);
                    })
                    .finally(() => {
                        modal.style.display = 'none';
                    });
            };

            btnNao.onclick = function () {
                modal.style.display = 'none';
            };

            modal.style.display = 'block';
        }
    </script>
</body>

</html>
