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
      $this->id = $id;
      $this->rua = $rua;
      $this->numero = $numero;
      $this->bairro = $bairro;
      $this->cidade = $cidade;
      $this->estado = $estado;
      $this->cep = $cep;
    }
  }
?>