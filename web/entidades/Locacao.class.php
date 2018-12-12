<?php
  class Locacao {
    public $id;
    public $data_locacao;
    public $data_devolucao;
    public $nome_usuario;
    public $jogo;

    // public $status;
    // public $midia;

    function __construct($id, $data_locacao, $data_devolucao, $nome_usuario, $jogo /*$status, $midia*/){
      $this->id = $id;
      $this->data_locacao = $data_locacao;
      $this->data_devolucao = $data_devolucao;
      $this->nome_usuario = $nome_usuario;
      $this->jogo = $jogo;
      // $this->status = $status;
      // $this->midia = $midia;
    }
  }
?>