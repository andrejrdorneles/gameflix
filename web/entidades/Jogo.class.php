<?php

  class Jogo {
    public $id;
    public $nome;
    public $url_imagem;
    public $genero;
    public $data_lancamento;
    public $desenvolvedora;

    function __construct($id, $nome, $url_imagem, $genero, 
                          $data_lancamento, $desenvolvedora){
      $this->id = $id;
      $this->nome = $nome;
      $this->url_imagem = $url_imagem;
      $this->genero = $genero;
      $this->data_lancamento = $data_lancamento;
      $this->desenvolvedora = $desenvolvedora;
    }
  }
?>