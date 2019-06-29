<?php
  class Categoria {
    public $id;
    public $nome;
    public $dias_locacao;

    public function __construct($id, $nome, $dias_locacao){
      $this->nome = $nome;
      $this->dias_locacao = $dias_locacao;
      $this->id = $id;
    }
  }
?>