	<?php

	require 'model/modelo.php';

	$obj = new Productos();

	/* $fora = new llavesfor(); */

	if (isset($_POST['btnregistrar'])) {
		$nombre = $_POST['txtnombre'];
		$cantidad = $_POST['txtcantidad'];
		$idproveedor = $_POST['lstproveedores'];
		$idcategoria = $_POST['lstcategorias'];

		if ($_POST['btnregistrar'] == 'Insertar') {
			$obj->Insertar($nombre, $cantidad, $idproveedor, $idcategoria);
			header("Location:  index.php");
		} else if ($_POST['btnregistrar'] == 'Guardar') {
			$idproducto = $_POST['txtid'];
			$obj->Modificar($nombre, $cantidad, $idproveedor, $idcategoria, $idproducto);
		}
	} else if (isset($_GET['ideliminar'])) {
		$id = $_GET['ideliminar'];
		$obj->Eliminar($id);
	} else if (isset($_GET['idmodificar'])) {
		$id = $_GET['idmodificar'];

		$prod_mod = $obj->Modificarbuscar($id);
	}

	if (isset($_POST['btnbuscar'])) {
		$buscar = $_POST['txtbuscar'];
		$result = $obj->Buscar($buscar);
		$datos = $obj->Tabla_gen($result);
	} else {
		$result = $obj->Buscartodo();
		$datos = $obj->Tabla_gen($result);
	}

	$datos_proveedores = $obj->proveedores();

	$datos_categorias = $obj->categorias();

	require './view/vista.php'
	?>