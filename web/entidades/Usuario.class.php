<?php
  class Usuario {
    private $id;
    private $nome;
    private $telefone;
    private $email;
    private $endereco;
    private $data_nascimento;

    function __construct($nome, $telefone, $email, $endereco, $data_nascimento){
      $this->nome = $nome;
      $this->telefone = $telefone;
      $this->email = $email;
      $this->endereco = $endereco;
      $this->data_nascimento = $data_nascimento;
    }
  }
?>