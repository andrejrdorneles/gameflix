<?php
  include_once 'Categoria.class.php';
  include_once 'Desenvolvedora.class.php';
  include_once 'Genero.class.php';

  class Jogo {
    public $id;
    public $nome;
    public $url_imagem;
    public $categoria;
    public $genero;
    public $desenvolvedora;
    public $data_lancamento;

    function __construct($id, $nome, $url_imagem/* , $categoria, $genero, $desenvolvedora, $data_lancamento*/){
      $this->id = $id;
      $this->nome = $nome;
      $this->url_imagem = $url_imagem;
      //$this->categoria = $categoria;
      //$this->genero = $genero;
      //$this->desenvolvedora = $desenvolvedora;
      //$this->data_lancamento = $data_lancamento;
    }
  }
?>