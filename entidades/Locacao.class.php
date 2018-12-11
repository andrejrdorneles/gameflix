<?php
  class Locacao {
    private $id;
    private $status;
    private $midia;

    function __construct($status, $midia){
      $this->status = $status;
      $this->midia = $midia;
    }
  }
?>