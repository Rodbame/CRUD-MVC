<?php 
session_start();
 
require '../bd/conexion_bd.php';

$obj = new BD_PDO();

$correo = $_GET['p'];
$datos = $obj->Ejecutar_Instruccion("select * from usuarios where usuario='{$_GET['id_usuario']}'");

echo json_encode($datos);	



?>	