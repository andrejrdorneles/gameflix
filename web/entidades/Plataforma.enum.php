<?php
  class Plataforma {
    private const ENUM = array(
      "PlayStation 4",
      "Xbox One",
      "Nintendo Switch",
      "PC",
      "PlayStation 3"
    );
  
    static function get($id){
      return self::ENUM[$id - 1];
    }
  }
?>