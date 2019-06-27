<?php
  require_once('../config/connect.php');

  class BaseDAO {
    private $tabela;

    function __construct($tabela){
      $this->tabela = $tabela;
    }

    function mapearValoresInsert($valores){
      $map = " VALUES (";
      $count = count($valores);
      for ($i = 0; $i < $count; $i++){//TODO while lenght
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
      $sql = "INSERT INTO " . $this->tabela;
      $sql .= $this->mapearValoresInsert($valores);
    }

    function buscar($id){
      $sql = "SELECT * FROM " . $this->tabela . " WHERE id" 
                . $this->tabela . " = " . $id . ";";
    }

    function deletar($id){
      $sql = "DELETE FROM " . $this->tabela . " WHERE id" 
                . $this->tabela . " = " . $id . ";";
    }

    function mapearValoresUpdate($obj){
      $array = get_object_vars($obj);
      $map = "";
      $count = count($array);
      $i = 0;
      while ($prop = current($array)) {
        $key = key($array);
        $valor = $array[$key];
        if(is_string($valor)){
          $valor = "'".$valor."'";
        }
        
        $map .= str_replace("_", "", $key) . " = " . $valor;
        
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
    }

    function buscarTodos(){
      $sql = "SELECT * FROM " . $this->tabela . ";";
    }

  }
?>