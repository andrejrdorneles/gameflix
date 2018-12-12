<?php
require_once('base_controller.php');
require_once('../entidades/Operador.class.php');
require_once('../config/connect.php');

$jogo_controller = new OperadorController($mysqli, "jogo");

switch ($request_method) {
  case 'POST':
    $jogo_controller->post($data);
    break;
  default:
    echo json_response(500, $e);
    break;
}

class OperadorController
{
  public $connection;

  public function __construct($mysqli, $tabela)
  {
    $this->connection = $mysqli;
    $this->tabela = $tabela;
  }

  public function post($data)
  {
    try {
      $sql = "SELECT id, nome, login FROM operador WHERE login ='$data->login' AND senha = '$data->senha' ";
      $result = $this->connection->query($sql);
      $operador = new Operador($result['id'], $result['nome'], $result['login']);
      echo json_encode($operador);
    } catch (Exception $e) {
      echo json_response(500, $e);
    }
  }
}
?>