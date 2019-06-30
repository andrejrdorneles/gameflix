<?php
require_once('Base.controller.php');
require_once('../daos/Categoria.dao.php');

class CategoriaController extends BaseController {

  function __construct(){
    parent::__construct(new CategoriaDAO());
  }

}

$controller = new CategoriaController();
$controller->listen();

?>