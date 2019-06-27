<?php
  class Midia {
    private $id;
    private $plataforma;
    private $data_aquisicao;
    private $preco_locacao;
    private $jogo;
    private $categoria;
    
    function __construct($id, $jogo, $plataforma, $data_aquisicao){
      $this->id = $id;
      $this->plataforma = $plataforma;
      $this->data_aquisicao = $data_aquisicao;
      $this->preco_locacao = $preco_locacao;
      $this->jogo = $jogo;
      $this->categoria = $categoria;
    }
  }
?>