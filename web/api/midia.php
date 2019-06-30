<?php
require_once('Base.controller.php');
require_once('../daos/Midia.dao.php');

class MidiaController extends BaseController {
  private $categoriaDAO;
  private $jogoDAO;

  function __construct(){
    parent::__construct(new MidiaDAO());
    $this->categoriaDAO = new CategoriaDAO();
    $this->jogoDAO = new JogoDAO();
  }

}

$controller = new MidiaController();
$controller->listen();

?>