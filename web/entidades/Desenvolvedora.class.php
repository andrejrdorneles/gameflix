<?php
  class Desenvolvedora {
    public $id;
    public $nome;
    public $url_imgem;

    function __construct( $id, $nome, $url_imgem){
      $this->nome = $nome;
      $this->url_imgem = $url_imgem;
      $this->id = $id;
    }
  }
?>