<?php
  class Status {
    private const ENUM = array(
      "Ativo",
      "Inativo"
    );
  
    static function get($id){
      return self::ENUM[$id - 1];
    }
  }
?>