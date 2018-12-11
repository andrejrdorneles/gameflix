<?php
  class Pedido {
    private $id;
    private $usuario;
    private $operador;
    private $status;
    private $valor_total;
    private $valor_quitado;
    private $data_retirada;

    function __construct($usuario, $operador, $status, $valor_total, $valor_quitado, $data_retirada){
      $this->usuario = $usuario;
      $this->operador = $operador;
      $this->status = $status;
      $this->valor_total = $valor_total;
      $this->valor_quitado = $valor_quitado;
      $this->data_retirada = $data_retirada;
    }
  }
?>