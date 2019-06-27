<?php
  include_once 'Endereco.class.php';

  class Cliente {
    private $id;
    private $cpf;
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $data_nascimento;

    function __construct($cpf, $nome, $email, $telefone, 
                        $endereco, $data_nascimento, $id){
      $this->cpf = $cpf;
      $this->nome = $nome;
      $this->telefone = $telefone;
      $this->email = $email;
      $this->endereco = $endereco;
      $this->data_nascimento = $data_nascimento;
      $this->id = $id;
    }
  }
?>