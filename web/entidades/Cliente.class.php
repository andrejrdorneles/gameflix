<?php
  include_once 'Endereco.class.php';

  class Cliente {
    public $id;
    public $cpf;
    public $nome;
    public $telefone;
    public $email;
    public $data_nascimento;
    public $endereco;

    function __construct($id, $cpf, $nome, $email, $telefone, 
                          $data_nascimento, $endereco){
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