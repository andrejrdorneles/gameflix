<?php
require_once('Base.controller.php');
require_once('../daos/Locacao.dao.php');

class LocacaoController extends BaseController {
  private $categoriaDAO;
  private $jogoDAO;

  function __construct(){
    parent::__construct(new LocacaoDAO());
    $this->categoriaDAO = new CategoriaDAO();
    $this->jogoDAO = new JogoDAO();
  }

}

$controller = new LocacaoController();
$controller->listen();

?>