<?php
  class Operador {
    public $id;
    public $nome;
    public $login;
    private $senha;
    public $url_imagem;

    function __construct($id, $nome, $login, $senha, $url_imagem){
      $this->id = $id;
      $this->nome = $nome;
      $this->login = $login;
      $this->senha = $senha;
      $this->url_imagem = $url_imagem;
    }
  }
?>