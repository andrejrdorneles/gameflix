<?php
  class Endereco {
    private $id;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;

    function __construct( $id, $rua, $numero, $bairro,  
                          $cidade, $estado, $cep){
      $this->rua = $rua;
      $this->numero = $numero;
      $this->cidade = $cidade;
      $this->bairro = $bairro;
      $this->estado = $estado;
      $this->cep = $cep;
      $this->id = $id;
    }
  }
?>