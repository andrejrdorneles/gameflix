<?php
  include_once 'Endereco.class.php';

  class Cliente {
    public $id;
    public $cpf;
    public $nome;
    public $email;
    public $telefone;
    public $endereco;
    public $data_nascimento;

    function __construct($id, $cpf, $nome, $email, $telefone, 
                        $endereco, $data_nascimento){
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