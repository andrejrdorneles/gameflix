<?php
require_once('Base.controller.php');
require_once('../daos/Jogo.dao.php');

class JogoController extends BaseController {

  function __construct(){
    parent::__construct(new JogoDAO());
  }

}

$controller = new JogoController();
$controller->listen();

?>