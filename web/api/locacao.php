<?php
require_once('base_controller.php');
require_once('../entidades/Jogo.class.php');
require_once('../entidades/Locacao.class.php');
require_once('../config/connect.php');

$jogo_controller = new LocacaoController($mysqli, "locacao");

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

class LocacaoController
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
      $jogo_sql = "SELECT * FROM jogo WHERE id = '$data->jogo_id'";
      $jogo_result = $this->connection->query($jogo_sql);
      if (mysqli_num_rows($jogo_result) == 0) {
        throw new Exception("Jogo inválido");
      }
      $jogo_dados = mysqli_fetch_array($jogo_result);
      $jogo = new Jogo(
        $jogo_dados['id'],
        $jogo_dados['nome'],
        $jogo_dados['url_imagem']
      );

      $data_locacao = date('d/m/Y', strtotime($data->data_locacao));
      $data_devolucao = date('d/m/Y', strtotime('+5 days', strtotime($data->data_locacao)));
      $sql = "INSERT INTO " . $this->tabela . " (data_locacao, data_devolucao, nome_usuario, jogo_id)
              VALUES ('$data_locacao', '$data_devolucao', '$data->nome_usuario', '$data->jogo_id')";
      $this->connection->query($sql);
      $id = $this->connection->insert_id;
      $locacao = new Locacao(
        $id,
        $data_locacao,
        $data_devolucao,
        $data->nome_usuario,
        $jogo
      );
      echo json_encode($locacao);
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