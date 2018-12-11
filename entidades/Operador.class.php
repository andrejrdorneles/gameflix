<?php
  class Operador {
    private $id;
    private $nome;
    private $senha;
    private $login;
    private $endereco;
    private $data_nascimento;

    function __construct($nome, $senha, $login){
      $this->nome = $nome;
      $this->senha = $senha;
      $this->login = $login;
    }
  }
?>