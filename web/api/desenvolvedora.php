<?php
require_once('Base.controller.php');
require_once('../daos/Desenvolvedora.dao.php');

class DesenvolvedoraController extends BaseController {

  function __construct(){
    parent::__construct(new DesenvolvedoraDAO());
  }

}

$controller = new DesenvolvedoraController();
$controller->listen();

?>