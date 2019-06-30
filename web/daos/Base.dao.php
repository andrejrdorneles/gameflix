<?php
  require_once('../config/connect.php');

  abstract class BaseDAO {
    private $tabela;
    public $insertArray;

    function __construct($tabela, $insertArray){
      $this->tabela = $tabela;
      $this->insertArray = $insertArray;
      $this->conn = $GLOBALS['conn'];
    }

    function closeConn(){
      oci_close($this->conn);
    }

    function mapearCamposInsert(){
      $map = "(";
      $count = count($this->insertArray);
      for ($i = 0; $i < $count; $i++){
        $valor = $$this->insertArray[$i];
      
        $map .= $valor; 
      
        if($i != ($count - 1)){
          $map .= ", ";
        }else{
          $map .= ") ";
        }
      }
      return $map;
    }

    function mapearValoresInsert($valores){
      $map = " VALUES (";
      $count = count($valores);
      for ($i = 0; $i < $count; $i++){
        $valor = $valores[$i];
        if(is_string($valor)){
          $valor = "'".$valor."'";
        }
      
        $map .= $valor; 
      
        if($i != ($count - 1)){
          $map .= ", ";
        }else{
          $map .= ");";
        }
      }
      return $map;
    }

    function inserir($valores){
      $sql = "INSERT INTO " . $this->tabela . " " . $this->mapearCamposInsert();
      $sql .= $this->mapearValoresInsert($valores);

      $this->closeConn();
    }

    function buscar($id){
      $sql = "SELECT * FROM " . $this->tabela . " WHERE id" 
                . $this->tabela . " = " . $id;

      $stid = oci_parse($this->conn, $sql);
      oci_execute($stid);
      $this->closeConn();
      
      return $stid; 
    }

    function buscarPorCampoEValor($campo, $valor){
      $sql = "SELECT * FROM " . $this->tabela . " WHERE " 
                . $campo . " = " . $valor;

      $stid = oci_parse($this->conn, $sql);
      oci_execute($stid);
      $this->closeConn();

      return $stid; 
    }

    function deletar($id){
      $sql = "DELETE FROM " . $this->tabela . " WHERE id" 
                . $this->tabela . " = " . $id . ";";

      $this->closeConn();
    }

    function removeUnderline($valor){
      return str_replace("_", "", $valor);
    }

    function mapearValoresUpdate($obj){
      $array = get_object_vars($obj);
      unset($array["id"]);
      $map = "";
      $count = count($array);
      $i = 0;
      while ($prop = current($array)) {
        $key = key($array);
        $valor = $array[$key];
        if(is_string($valor)){
          $valor = "'".$valor."'";
        }
        
        $map .= $this->removeUnderline($key) . " = " . $valor;
        
        if($i != ($count - 1)){
          $map .= ", ";
        }else{
          $map .= " ";
        }
        $i++;
        next($array);
      }

      return $map;
    }

    function atualizar($obj){
      $sql = "UPDATE ". $this->tabela . " SET ";
      $sql .= $this->mapearValoresUpdate($obj);
      $sql .= "WHERE id" . $this->tabela . " = " . $obj->id;

      $this->closeConn();
    }

    function buscarTodos(){
      $sql = "SELECT * FROM " . $this->tabela;
      $stid = oci_parse($this->conn, $sql);
      oci_execute($stid);
      $this->closeConn();

      return $stid;
    }

    abstract function mapear($row);

  }
?>