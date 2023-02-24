<?php

session_start();

require 'bd/conexion_bd.php';

class Productos extends BD_PDO
{

	function Insertar($nombre, $cantidad, $idproveedor, $idcategoria)
	{
		$this->Ejecutar_Instruccion("Insert into productos(Nombre,Cantidad,id_proveedor,id_categoria) values('$nombre','$cantidad','$idproveedor','$idcategoria')");
	}

	function Buscar($buscar)
	{
		$result = $this->Ejecutar_Instruccion("Select productos.id_producto,productos.Nombre,productos.Cantidad,concat(proveedores.Nombres,' ',proveedores.Apellido_p,' ',proveedores.Apellido_m) as Nombre_prov,categorias.Nombre from productos INNER JOIN proveedores ON productos.id_proveedor=proveedores.id_proveedor INNER JOIN categorias ON productos.id_categoria=categorias.id_categoria where productos.Nombre like '%$buscar%'");
		return $result;
	}

	function Buscartodo()
	{
		$result = $this->Ejecutar_Instruccion("Select productos.id_producto,productos.Nombre,productos.Cantidad,concat(proveedores.Nombres,' ',proveedores.Apellido_p,' ',proveedores.Apellido_m) as Nombre_prov,categorias.Nombre from productos INNER JOIN proveedores ON productos.id_proveedor=proveedores.id_proveedor INNER JOIN categorias ON productos.id_categoria=categorias.id_categoria;");
		return $result;
	}

	function Eliminar($id)
	{
		$this->Ejecutar_Instruccion("Delete from productos where id_producto = '$id'");
	}

	function Modificar($nombre, $cantidad, $idproveedor, $idcategoria, $idproducto)
	{
		$this->Ejecutar_Instruccion("Update productos set Nombre='$nombre',Cantidad='$cantidad',id_proveedor='$idproveedor',id_categoria='$idcategoria' where id_producto = '$idproducto'");
	}

	function Modificarbuscar($id)
	{
		$result = $this->Ejecutar_Instruccion("Select * from productos where id_producto = '$id'");
		return $result;
	}

	function Tabla_gen($result)
	{
		$tabla = "";
		foreach ($result as $renglon) {
			$tabla .= "<tr>";
			$tabla .= '<td>' . $renglon[0] . '</td>';
			$tabla .= '<td>' . $renglon[1] . '</td>';
			$tabla .= '<td>' . $renglon[2] . '</td>';
			$tabla .= '<td>' . $renglon[3] . '</td>';
			$tabla .= '<td>' . $renglon[4] . '</td>';
			$tabla .= '<td><input type="button" id="btneliminar" class="btn btn-danger" name="btneliminar" value="Eliminar" onclick="javascript: eliminar(' . $renglon[0] . ');"></td>';
			$tabla .= '<td><input type="button" id="btnmodificar" class="btn btn-warning" name="btnmodificar" value="Modificar" onclick="javascript: modificar(' . $renglon[0] . ');"></td>';
			$tabla .= '</tr>';
		}
		return $tabla;
	}

	function proveedores(){
		$result = $this->listados("Select id_proveedor,concat(Nombres,' ',Apellido_p,' ',Apellido_m) as Nombre_comp from proveedores", "Select id_proveedor from productos where id_producto='" . @$_GET['idmodificar'] . "'");
        return $result;
	}

	function categorias(){
        $result = $this->listados("Select id_categoria,Nombre from categorias", "Select id_categoria from productos where id_producto='" . @$_GET['idmodificar'] . "'");
        return $result;
    }

}
	/* 
	class llavesfor extends listados{
			function llaveproveedor(){
				$result = $fora->listados("Select id_proveedor,concat(Nombres,' ',Apellido_p,' ',Apellido_m) as Nombre_comp from proveedores","Select id_proveedor from productos where id_producto='".$_GET['idmodificar']."'");
			}
	}
	*/
