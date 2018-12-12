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

      $data_locacao = date('d-m-Y', strtotime($data->data_locacao));
      $data_devolucao = date('d-m-Y', strtotime('+5 days', strtotime($data->data_locacao)));
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
      $sql = "SELECT ".$this->tabela.".id, ".$this->tabela.".data_devolucao, ".$this->tabela.".data_locacao,".$this->tabela.".nome_usuario, 
                      ".$this->tabela.".jogo_id, jogo.nome, jogo.url_imagem
              FROM ".$this->tabela." 
              INNER JOIN `jogo` ON jogo.id = locacao.jogo_id";

      $result = $this->connection->query($sql);
      $dados = array();
      while ($dado = $result->fetch_assoc()) {
        $jogo = new Jogo($dado['jogo_id'], $dado['nome'], $dado['url_imagem']);
        $locacao = new Locacao(
          $dado['id'],
          $dado['data_locacao'],
          $dado['data_devolucao'],
          $dado['nome_usuario'],
          $jogo
        );
        array_push($dados, $locacao);
      }
      echo json_encode($dados);
    } catch (Exception $e) {
      echo json_response(500, $e);
    }
  }
}
?>