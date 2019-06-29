<?php
  class Midia {
    public $id;
    public $plataforma;
    public $data_aquisicao;
    public $preco_locacao;
    public $jogo;
    public $categoria;
    
    function __construct($id, $plataforma, $data_aquisicao, $preco_locacao, $jogo, $categoria){
      $this->id = $id;
      $this->plataforma = $plataforma;
      $this->data_aquisicao = $data_aquisicao;
      $this->preco_locacao = $preco_locacao;
      $this->jogo = $jogo;
      $this->categoria = $categoria;
    }
  }
?>