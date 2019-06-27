<?php
  class Endereco {
    private $id;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;

    function __construct($rua, $numero, $bairro, $cidade, 
                        $estado, $cep, $id){
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