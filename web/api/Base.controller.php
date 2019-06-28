<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, PUT, OPTIONS");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

abstract class BaseController
{
  public $data;
  public $request_method;
  public $get;

  public function listen(){
    $this->request_method = $_SERVER['REQUEST_METHOD'];
    $this->get = $_GET;
    $this->data = file_get_contents("php://input");

    switch ($this->request_method) {
      case 'POST':
        $this->post();
        break;
      case 'GET':
        $this->get();
        break;
      case 'PUT':
        $this->put();
        break;
      case 'DELETE':
        $this->delete();
        break;
      default:
        echo 'Invalid Method';
        break;
    }
  }

  public function post() {
    echo 'Not implemented';
  }

  public function get() {
    echo 'Not implemented';
  }

  public function put() {
    echo 'Not implemented';
  }

  public function delete() {
    echo 'Not implemented';
  }
}

?>