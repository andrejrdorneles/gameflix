<?php
  class Genero {
    private const ENUM = array(
      "Ação/Aventura",
      "Luta",
      "Tiro/Shoter",
      "Role-Playng Game (RPG)",
      "Construção/Gerenciamento",
      "Vida Virtual",
      "Música/Ritmo",
      "Esportes",
      "Simulação de veículo"
    );
  
    static function get($id){
      return self::ENUM[$id - 1];
    }
  }
?>
