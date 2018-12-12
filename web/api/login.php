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
      $data->senha = md5($data->senha);
      $sql = "SELECT id, nome, login, url_imagem FROM operador 
              WHERE login ='$data->login' AND senha = '$data->senha'";
      $result = $this->connection->query($sql);
      if (mysqli_num_rows($result) == 0) {
        throw new Exception("Usuário inválido");
      }
      $dado = mysqli_fetch_array($result);
      $operador = new Operador(
        $dado['id'],
        $dado['nome'],
        $dado['login'],
        $dado['url_imagem']
      );
      
      echo json_encode($operador);
    } catch (Exception $e) {
      echo json_response(500, $e);
    }
  }
}
?>