<?php
  class Pedido {
    public $id;
    public $status;
    public $valor_total;
    public $valor_quitado;
    public $data_retirada;
    public $cliente;
    public $operador;

    function __construct($id, $status,  $valor_total, $valor_quitado, 
                          $data_retirada, $cliente, $operador){
      $this->id = $id;
      $this->cliente = $cliente;
      $this->operador = $operador;
      $this->status = $status;
      $this->valor_total = $valor_total;
      $this->valor_quitado = $valor_quitado;
      $this->data_retirada = $data_retirada;
    }
  }
?>