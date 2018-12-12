<?php
  class Operador {
    public $id;
    public $nome;
    public $senha;
    public $login;
    public $url_imagem;
    private $endereco;
    private $data_nascimento;

    function __construct($id, $nome, $senha, $login, $url_imagem){
      $this->id = $id;
      $this->nome = $nome;
      $this->login = $login;
      $this->url_imagem = $url_imagem;
    }
  }
?>