<?php
  require_once('Base.dao.php');
  require_once('../entidades/Jogo.class.php');
  require_once('../daos/Desenvolvedora.dao.php');
  require_once('../entidades/Desenvolvedora.class.php');

  class JogoDAO extends BaseDAO {

    public $desenvolvedoraDAO;

    function __construct(){
      parent::__construct("Jogo", 
        array("nome", "urlImagem", "genero", "dataLancamento", "idDesenvolvedora"));
      $this->desenvolvedoraDAO = new DesenvolvedoraDAO();
    }

    function buscarTodos(){
      $response = array();
      $result = parent::buscarTodos();
      
      while ($row = oci_fetch_array($result, OCI_NUM)) {
        $obj = $this->mapear($row);
        array_push($response, $obj);
      }

      return $response;
    }

    function buscar($id){
      $result = oci_fetch_array(parent::buscar($id), OCI_NUM);

      return $this->mapear($result);
    }

    function mapear($row){
      $desenvolvedora = $this->desenvolvedoraDAO->buscar($row[5]);
      return new Jogo($row[0], $row[1], $row[2], $row[3], $row[4], $desenvolvedora);
    }
  }
?>