<?php
require "../config/conexion.php";
Class Permiso {
  public function __construct(){
  }
  public function listar (){
    $sql = "SELECT nombre FROM permiso";
    return ejecutarConsulta ($sql);
  }
}
 ?>
