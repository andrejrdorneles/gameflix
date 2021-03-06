<?php
  require_once('Base.dao.php');
  require_once('../entidades/Jogo.class.php');
  require_once('../entidades/Genero.enum.php');
  require_once('../daos/Desenvolvedora.dao.php');
  require_once('../entidades/Desenvolvedora.class.php');

  class JogoDAO extends BaseDAO {

    public $desenvolvedoraDAO;

    function __construct(){
      parent::__construct("Jogo", 
        array("nome", "url_imagem", "genero", "data_lancamento", "id_desenvolvedora"));
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
      $desenvolvedora = $this->desenvolvedoraDAO->buscar($row[5]);
      return new Jogo($row[0], $row[1], $row[2], Genero::get($row[3]), $row[4], $desenvolvedora);
    }
  }
?>