<?php
  require_once('Base.dao.php');
  require_once('../entidades/Midia.class.php');
  require_once('../entidades/Plataforma.enum.php');
  require_once('../daos/Jogo.dao.php');
  require_once('../daos/Categoria.dao.php');
  

  class MidiaDAO extends BaseDAO {

    private $jogoDAO;
    private $categoriaDAO;

    function __construct(){
      parent::__construct("Midia", 
        array("plataforma", "data_aquisicao", "preco_locacao", "id_jogo", "id_categoria"));
      $this->jogoDAO = new JogoDAO();
      $this->categoriaDAO = new CategoriaDAO();
    }

    function buscarTodos(){
      $response = array();
      $consulta = parent::buscarTodos();
      
      while ($row = oci_fetch_array($consulta, OCI_NUM)) {
        $obj = $this->mapear($row);
        array_push($response, $obj);
      }

      return $response;
    }

    function buscar($id){
      $result = oci_fetch_array(parent::buscar($id), OCI_NUM);

      return $this->mapear($result);
    }

    function inserir($valores){
      $valores = $array = get_object_vars($valores);
      $result = parent::inserir($valores);
      
      return $this->mapearArray($result, $valores);
    }

    function atualizar($valores){
      $valores = $array = get_object_vars($valores);
      $result = parent::atualizar($valores);
      
      return $this->mapearArray($valores['id'], $valores);
    }

    function mapearArray($result, $valores){
      return $this->mapear(array($result, $valores[$this->insertArray[0]], 
        $valores[$this->insertArray[1]], $valores[$this->insertArray[2]],
        $valores[$this->insertArray[3]], $valores[$this->insertArray[4]]));
    }
    
    function mapear($row){
      $jogo = $this->jogoDAO->buscar($row[4]);
      $categoria = $this->categoriaDAO->buscar($row[5]);
      return new Midia($row[0], Plataforma::get($row[1]), $row[2], $row[3], $jogo, $categoria);
    }
    
  }
?>