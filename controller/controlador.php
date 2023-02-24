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

	$datos_proveedores = $obj->listados("Select id_proveedor,concat(Nombres,' ',Apellido_p,' ',Apellido_m) as Nombre_comp from proveedores", "Select id_proveedor from productos where id_producto='" . @$_GET['idmodificar'] . "'");

	$datos_categorias = $obj->listados("Select id_categoria,Nombre from categorias", "Select id_categoria from productos where id_producto='" . @$_GET['idmodificar'] . "'");

	require './view/vista.php'
	?>