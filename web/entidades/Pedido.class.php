<?php
  class Pedido {
    private $id;
    private $status;
    private $valor_total;
    private $valor_quitado;
    private $data_retirada;
    private $cliente;
    private $operador;

    function __construct($id, $cliente, $operador, $status, $valor_total, 
                          $valor_quitado, $data_retirada){
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