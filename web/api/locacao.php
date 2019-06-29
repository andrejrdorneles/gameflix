<?php
require_once('Base.controller.php');
require_once('../daos/Pedido.dao.php');
require_once('../daos/Jogo.dao.php');
require_once('../daos/Locacao.dao.php');
require_once('../entidades/Jogo.class.php');
require_once('../entidades/Categoria.class.php');
require_once('../entidades/Locacao.class.php');

class LocacaoController extends BaseController {
  private $categoriaDAO;
  private $jogoDAO;

  function __construct(){
    parent::__construct(new LocacaoDAO());
    $this->categoriaDAO = new CategoriaDAO();
    $this->jogoDAO = new JogoDAO();
  }

  public function post() {
    echo json_encode("LocacaoController");
  }

  public function get(){
    $response = array();
    $consulta = $this->dao->buscarTodos();
    
    while ($row = oci_fetch_array($consulta, OCI_NUM)) {

      $getCat = oci_fetch_array($this->categoriaDAO->buscar($row[5]), OCI_NUM);
      $getJogo = oci_fetch_array($this->jogoDAO->buscar($row[4]), OCI_NUM);

      $categoria = new Categoria($getCat[0], $getCat[1], $getCat[2]);
      $jogo = new Jogo($getJogo[0], $getJogo[1], $getJogo[2], $getJogo[3], $getJogo[4], $getJogo[5]);

      $obj = new Locacao($row[0], $row[1], $row[2], $row[3], $jogo, $categoria);
      array_push($response, $obj);
    }
    
    echo json_encode($response);
  }
}

$controller = new LocacaoController();
$controller->listen();

?>