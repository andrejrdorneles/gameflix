<?php
  class Endereco {
    public $id;
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $cep;

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