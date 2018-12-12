<?php
require_once('base_controller.php');
require_once('../entidades/Jogo.class.php');
require_once('../config/connect.php');

$jogo_controller = new JogoController($mysqli, "jogo");

switch ($request_method) {
  case 'POST':
    $jogo_controller->post($data);
    break;
  case 'GET':
    $jogo_controller->get($data);
    break;
  case 'PUT':
    $jogo_controller->put($data);
    break;
  case 'DELETE':
    $jogo_controller->delete($_GET['id']);
    break;
  default:
    break;
}

class JogoController
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
      $sql = "INSERT INTO " . $this->tabela . " (nome, url_imagem)
              VALUES ('$data->nome', '$data->url_imagem')";
      $this->connection->query($sql);
      $id = $this->connection->insert_id;
      $jogo = new Jogo($id, $data->nome, $data->url_imagem);
      echo json_encode($jogo);
    } catch (Exception $e) {
      echo json_response(500, $e);
    }
  }

  public function get($data)
  {
    try {
      $sql = "SELECT * FROM " . $this->tabela;
      if ($data->filtros !== null || !empty($data->filtros)) {
        $sql = $sql . " WHERE ";
        foreach ($data->filtros as $filtro) {
          $condicional = is_null($filtro->condicional) || empty($filtro->condicional) ? "" : $filtro->condicional;
          $sql = $sql . " " . $condicional . " " . $filtro->campo . " LIKE '%" . $filtro->valor . "%'";
        }
      }
      $result = $this->connection->query($sql);
      $dados = array();
      while ($dado = $result->fetch_assoc()) {
        $jogo = new Jogo($dado['id'], $dado['nome'], $dado['url_imagem']);
        array_push($dados, $jogo);
      }
      echo json_encode($dados);
    } catch (Exception $e) {
      echo json_response(500, $e);
    }
  }

  public function put($data)
  {
    try {
      $sql = "UPDATE " . $this->tabela . " SET nome = '$data->nome', url_imagem = '$data->url_imagem'
              WHERE id = " . $data->id;
      $this->connection->query($sql);
      $jogo = new Jogo($data->id, $data->nome, $data->url_imagem);
      echo json_encode($jogo);
    } catch (Exception $e) {
      echo json_response(500, $e);
    }
  }

  public function delete($id)
  {
    try {
      $sql = "DELETE FROM " . $this->tabela . " WHERE id = " . $id;
      $this->connection->query($sql);
    } catch (Exception $e) {
      echo json_response(500, $e);
    }
  }
}
?>