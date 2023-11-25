<?php

class Comunidade {
    protected $idComunidade;
    protected $nomeComunidade;
    protected $assuntoComunidade;
    protected $linkComunidade;
    protected $imgComunidade;
    protected $situacaoComunidade;
    protected $idUsuario;
    protected $dataComunidade;
    protected $usuario;

    // Métodos Get

    public function setUsuario(Usuario $usuario) {
        $this->usuario = $usuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getIdComunidade() {
        return $this->idComunidade;
    }

    public function getNomeComunidade() {
        return $this->nomeComunidade;
    }

    public function getAssuntoComunidade() {
        return $this->assuntoComunidade;
    }

    public function getLinkComunidade() {
        return $this->linkComunidade;
    }

    public function getImgComunidade() {
        return $this->imgComunidade;
    }

    public function getSituacaoComunidade() {
        return $this->situacaoComunidade;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getDataComunidade() {
        return $this->dataComunidade;
    }

    // Métodos Set
    public function setIdComunidade($idComunidade) {
        $this->idComunidade = $idComunidade;
    }

    public function setNomeComunidade($nomeComunidade) {
        $this->nomeComunidade = $nomeComunidade;
    }

    public function setAssuntoComunidade($assuntoComunidade) {
        $this->assuntoComunidade = $assuntoComunidade;
    }

    public function setLinkComunidade($linkComunidade) {
        $this->linkComunidade = $linkComunidade;
    }

    public function setImgComunidade($imgComunidade) {
        $this->imgComunidade = $imgComunidade;
    }

    public function setSituacaoComunidade($situacaoComunidade) {
        $this->situacaoComunidade = $situacaoComunidade;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setDataComunidade($dataComunidade) {
        $this->dataComunidade = $dataComunidade;
    }
}

?>
