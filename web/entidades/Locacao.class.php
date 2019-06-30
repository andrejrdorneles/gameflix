<?php
  class Locacao {
    public $id;
    public $data_locacao;
    public $data_devolucao;
    public $status;
    public $midia;
    private $pedido;

    function __construct($id, $data_locacao, $data_devolucao, $status,
                          $midia, $pedido ){
      $this->id = $id;
      $this->data_locacao = $data_locacao;
      $this->data_devolucao = $data_devolucao;
      $this->status = $status;
      $this->midia = $midia;
      $this->pedido = $pedido;
      
    }
  }
?>