<?php
require_once('Base.controller.php');
require_once('../daos/Cliente.dao.php');

class ClienteController extends BaseController {

  function __construct(){
    parent::__construct(new ClienteDAO());
  }

}

$controller = new ClienteController();
$controller->listen();

?>