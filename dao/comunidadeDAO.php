<?php

class comunidadeDAO
{

    public function createComunidade(Comunidade $comunidade)
{
    try {
        $sql = "INSERT INTO tbcomunidade (nomeComunidade, assuntoComunidade, linkComunidade, imgComunidade, situacaoComunidade, idUsuario, dataComunidade) 
        VALUES (:nomeComunidade, :assuntoComunidade, :linkComunidade, :imgComunidade, :situacaoComunidade, :idUsuario, :dataComunidade);";

        $query = conexao::getConexao()->prepare($sql);
        $query->bindValue(':nomeComunidade', $comunidade->getNomeComunidade());
        $query->bindValue(':assuntoComunidade', $comunidade->getAssuntoComunidade());
        $query->bindValue(':linkComunidade', $comunidade->getLinkComunidade());
        $query->bindValue(':imgComunidade', $comunidade->getImgComunidade());
        $comunidade->setSituacaoComunidade(1);
        $query->bindValue(':situacaoComunidade', $comunidade->getSituacaoComunidade());
        $query->bindValue(':idUsuario', $comunidade->getIdUsuario());
        $query->bindValue(':dataComunidade', $comunidade->getDataComunidade());

        $query->execute();


        
    } catch (PDOException $e) {
        echo "Erro na inserção: " . $e->getMessage();
    }
}

public function readComunidadesEmEspera()
{
    $comunidades = array();

    $sql = "SELECT c.idComunidade, c.nomeComunidade, c.assuntoComunidade, c.linkComunidade, c.imgComunidade, c.situacaoComunidade, c.dataComunidade,
            u.nomeUsuario AS nomeUsuario, u.fotoUsuario AS fotoPerfil, u.idUsuario AS idUsuario
        FROM tbcomunidade AS c
        INNER JOIN tbusuario AS u ON c.idUsuario = u.idUsuario
        WHERE c.situacaoComunidade = 1";

    try {
        $query = conexao::getConexao()->prepare($sql);
        $query->execute();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $comunidade = new Comunidade();
            $comunidade->setIdComunidade($row['idComunidade']);
            $comunidade->setNomeComunidade($row['nomeComunidade']);
            $comunidade->setAssuntoComunidade($row['assuntoComunidade']);
            $comunidade->setLinkComunidade($row['linkComunidade']);
            $comunidade->setImgComunidade($row['imgComunidade']);
            $comunidade->setSituacaoComunidade($row['situacaoComunidade']);
            $comunidade->setDataComunidade($row['dataComunidade']);

            $usuario = new Usuario();
            $usuario->setIdUsuario(isset($row['idUsuario']) ? $row['idUsuario'] : null);
            $usuario->setNomeUsuario(isset($row['nomeUsuario']) ? $row['nomeUsuario'] : null);
            $usuario->setFotoDePerfil(isset($row['fotoPerfil']) ? $row['fotoPerfil'] : null); // Defina a foto de perfil aqui
            $comunidade->setUsuario($usuario);

            $comunidades[] = $comunidade;
        }
    } catch (PDOException $e) {
        echo "Erro na busca: " . $e->getMessage();
    }

    return $comunidades;
}


public function readComunidadesAprovadas()
{
    $comunidades = array();

    $sql = "SELECT c.idComunidade, c.nomeComunidade, c.assuntoComunidade, c.linkComunidade, c.imgComunidade, c.situacaoComunidade, c.dataComunidade,
            u.nomeUsuario AS nomeUsuario, u.fotoUsuario AS fotoPerfil, u.idUsuario AS idUsuario
        FROM tbcomunidade AS c
        INNER JOIN tbusuario AS u ON c.idUsuario = u.idUsuario
        WHERE c.situacaoComunidade = 2";

    try {
        $query = conexao::getConexao()->prepare($sql);
        $query->execute();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $comunidade = new Comunidade();
            $comunidade->setIdComunidade($row['idComunidade']);
            $comunidade->setNomeComunidade($row['nomeComunidade']);
            $comunidade->setAssuntoComunidade($row['assuntoComunidade']);
            $comunidade->setLinkComunidade($row['linkComunidade']);
            $comunidade->setImgComunidade($row['imgComunidade']);
            $comunidade->setSituacaoComunidade($row['situacaoComunidade']);
            $comunidade->setDataComunidade($row['dataComunidade']);

            $usuario = new Usuario();
            $usuario->setIdUsuario(isset($row['idUsuario']) ? $row['idUsuario'] : null);
            $usuario->setNomeUsuario(isset($row['nomeUsuario']) ? $row['nomeUsuario'] : null);
            $usuario->setFotoDePerfil(isset($row['fotoPerfil']) ? $row['fotoPerfil'] : null);
            $comunidade->setUsuario($usuario);

            $comunidades[] = $comunidade;
        }
    } catch (PDOException $e) {
        echo "Erro na busca: " . $e->getMessage();
    }

    return $comunidades;
}


public function updateSituacaoComunidade($idComunidade, $novaSituacao)
{
    try {
        $conexao = conexao::getConexao(); // Correção aqui
        $sql = "UPDATE tbcomunidade SET situacaoComunidade = :novaSituacao WHERE idComunidade = :idComunidade";
        $query = $conexao->prepare($sql); // Correção aqui
        $query->bindParam(':novaSituacao', $novaSituacao, PDO::PARAM_INT);
        $query->bindParam(':idComunidade', $idComunidade, PDO::PARAM_INT);
        $query->execute();
        return true;
    } catch (PDOException $e) {
        // Lidar com o erro, log, ou retornar false
        return false;
    }
}

public function excluirComunidade($idComunidade)
{
    try {
        $sql = "DELETE FROM tbcomunidade WHERE idComunidade = :idComunidade";
        $query = conexao::getConexao()->prepare($sql);
        $query->bindParam(':idComunidade', $idComunidade, PDO::PARAM_INT);
        $query->execute();
        return true;
    } catch (PDOException $e) {
        // Lidar com o erro, log, ou retornar false
        return false;
    }
}


}

   