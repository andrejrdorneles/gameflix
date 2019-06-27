<?php
  class Desenvolvedora {
    private $id;
    private $nome;
    private $url_imgem;

    function __construct($nome, $url_imgem, $id){
      $this->nome = $nome;
      $this->url_imgem = $url_imgem;
      $this->id = $id;
    }
  }
?>