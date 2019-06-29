<?php
  require_once('Base.dao.php');

  class PedidoDAO extends BaseDAO {
    function __construct(){
      parent::__construct("Pedido", 
        array("status", "valortotal", "valorquitado", "dataretirada", "idcliente", "idoperador"));
    }
  }
?>