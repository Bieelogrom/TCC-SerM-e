<?php

class conexao
{

    public static $conn;

    private function __construct()
    {
        //
    }


    public static function getConexao()
    {
        if (!isset(self::$conn)) {
            self::$conn = new PDO('mysql:host=localhost;dbname=bdsermae_upd', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$conn;
    }


    public static function searchInDatabase($searchTerm)
    {
        $conn = self::getConexao(); // Obtém a conexão da classe
    
        // Consulta preparada para evitar SQL injection
        $query = "
            (SELECT idComunidade as id, nomeComunidade as nome, assuntoComunidade as assunto, linkComunidade as link, imgComunidade as img, situacaoComunidade as situacao, dataComunidade as data, idUsuario as usuario_id, null as legenda, null as imgPublicacao, null as dataPublicacao, null as numCurtidas, null as numCompartilhamentos FROM tbcomunidade WHERE nomeComunidade LIKE ?)
            UNION
            (SELECT null as id, null as nome, null as assunto, null as link, null as img, null as situacao, null as data, null as usuario_id, legendaPublicacao as legenda, imgPublicacao as imgPublicacao, dataPublicacao as dataPublicacao, numCurtidasPublicacao as numCurtidas, numCompartPublicacao as numCompartilhamentos FROM tbpublicacao WHERE legendaPublicacao LIKE ?)
            UNION
            (SELECT null as id, nomeUsuario as nome, null as assunto, null as link, null as img, null as situacao, null as data, null as usuario_id, null as legenda, null as imgPublicacao, null as dataPublicacao, null as numCurtidas, null as numCompartilhamentos FROM tbusuario WHERE nomeUsuario LIKE ?)
            ORDER BY data DESC, dataPublicacao DESC
        ";
    
        $stmt = $conn->prepare($query);
    
        // Adicione "%" aos lados do termo de pesquisa para corresponder parcialmente
        $searchTerm = '%' . $searchTerm . '%';
    
        // Vincular parâmetros
        $stmt->bindParam(1, $searchTerm, PDO::PARAM_STR);
        $stmt->bindParam(2, $searchTerm, PDO::PARAM_STR);
        $stmt->bindParam(3, $searchTerm, PDO::PARAM_STR);
    
        $stmt->execute();
    
        // Obter resultados
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Fechar a conexão
        $stmt->closeCursor();
    
        // Retornar os resultados
        return $result;
    }
    


}
