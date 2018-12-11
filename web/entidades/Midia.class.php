<?php
  class Midia {
    private $id;
    private $jogo;
    private $plataforma;
    private $data_aquisicao;

    function __construct($jogo, $plataforma, $data_aquisicao){
      $this->jogo = $jogo;
      $this->plataforma = $plataforma;
      $this->data_aquisicao = $data_aquisicao;
    }
  }
?>