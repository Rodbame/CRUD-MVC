<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro de productos</title>

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<link type="text/css" rel="stylesheet" href="css/style1.css" />
	<link rel="stylesheet" href="https://kit.fontawesome.com/4474c542fd.css" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css"/>

	<script>
		function eliminar(id) {
			if (confirm("¿ Estas seguro de eliminar el registro ?")) {
				window.location = "index.php?ideliminar=" + id;
			}
		}

		function modificar(id) {
			window.location = "index.php?idmodificar=" + id;
			//window.location = "Registro-juguetes.php"
		}

		function cerrar_sesion() {
			if (confirm("¿ Estas seguro de cerrar la sesión ?")) {
				window.location = "cerrar_sesion.php";
			}
		}


		function validar() {
			var nombre = document.getElementById("txtnombre").value;
			var cantidad = document.getElementById("txtcantidad").value;
			var proveedor = document.getElementById("lstproveedores").value;
			var categoria = document.getElementById("lstcategorias").value;


			if (nombre.trim().length < 1) {
				alert("El nombre del producto esta vacio");
				return false;
			}

			if (nombre.trim().length != nombre.length) {
				alert("Tienes espacios de mas en el nombre");
				return false;
			}

			if (cantidad.trim().length < 1) {
				alert("La cantidad del producto esta vacia");
				return false;
			}

			if (cantidad.trim().length != cantidad.length) {
				alert("Tienes espacios de mas en la cantidad");
				return false;
			}

			if (proveedor.trim().length < 1) {
				alert("El proveedor esta vacios, seleccione alguno");
				return false;
			}

			if (categoria.trim().length < 1) {
				alert("La categoria esta vacia, seleccione alguna");
				return false;
			}


			return true;
		}


		function verificar_producto(id) {
			$.getJSON("validaciones/verificar_producto.php?p=" + id).done(function(datos) {
				if (datos[0][0] > 0) {
					alert("Producto ya existe, verifique");
				}
			});
		}

		function verificar_cantidad() {
			var cant = document.getElementById("txtcantidad").value;

			if (cant >= 0) {
				return true;
			} else if (cant < 0) {
				alert("La cantidad no puede ser negativa");
				return false;
			}
		}
	</script>


</head>

<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="active"><a href="index.php"> Productos</a></li>
			</ul>
			<!-- /NAV -->
		</div>
		<!-- /responsive-nav -->
	</div>
	<!-- /container -->
</nav>
<!-- /NAVIGATION -->

<body>

	<br>

	<div style="display: flex; align-items: center; justify-content: center;">
		<h1>Registro de productos</h1>
	</div>


	<div class="container " style="display: flex; align-items: center; justify-content: center;">
		<form action="index.php" method="post" id="frminsertar" name="frminsertar" onsubmit="return validar();">


			<input type="text" id="txtid" name="txtid" placeholder="Numero" value="<?php echo @$prod_mod[0][0]; ?>" hidden>
			<br>
			<br>
			Nombre del producto
			<input type="text" class="input" id="txtnombre" name="txtnombre" pattern="[a-z-A-Z ]+" onblur="javascript: verificar_producto(this.value);" maxlength="50" placeholder="Nombre" value="<?php echo @$prod_mod[0][1]; ?>">
			<br>
			<br>
			Cantidad
			<input type="text" class="input" id="txtcantidad" name="txtcantidad" onblur="javascript: verificar_cantidad();" maxlength="11" placeholder="Cantidad" value="<?php echo @$prod_mod[0][4]; ?>"> <!-- -->
			<br>
			<br>
			Proveedor
			<select name="lstproveedores" id="lstproveedores" class="input">
				<option value="">Seleccione Proveedor</option>
				<?php echo $datos_proveedores; ?>
			</select>
			<br><br>
			Categoria
			<select name="lstcategorias" id="lstcategorias" class="input">
				<option value="">Seleccione Categorias</option>
				<?php echo $datos_categorias; ?>
			</select>
			<br><br>
			<div style="display: flex; align-items: center; justify-content: center;">
				<input type="submit" class="btn " id="btnregistrar" name="btnregistrar" value="<?php if (isset($_GET['idmodificar'])) {
																									echo 'Guardar';
																								} else {
																									echo 'Insertar';
																								} ?>">
			</div>
		</form>
	</div>

	<br><br>

	<div class="container" style="display: flex; align-items: center; justify-content: center;">

		<h1>Listado de Productos</h1>

	</div>


	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->

			<!-- Billing Details -->
			<div class="col-md-7">
				<div class="header-search">

					<form action="index.php" id="frmbuscar" name="frmbuscar" method="POST">
						<input class="input" type="text" id="txtbuscar" name="txtbuscar" placeholder="Buscar productos por nombre">
						<input class="blue-btn" type="submit" id="btnbuscar" name="btnbuscar" value="Buscar">
					</form>

				</div>
			</div>
		</div>
	</div>
	<!-- SECTION -->

	<div class="container" style="display: flex; align-items: center; justify-content: center;">
		<div>

		</div>
		<table class="table table-striped" id="myTable">
			<tr>
				<td>Num</td>
				<td>Nombre</td>
				<td>Cantidad</td>
				<td>Proveedor</td>
				<td>Categoria</td>
				<td colspan="2" align="center">Accion</td>
				<?php echo $datos; ?>
		</table>
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script>
	$(document).ready(function() {
		$('#myTable').DataTable({
			language: {
				url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/es-MX.json'
			}
		});
	});
</script>

</body>

</html>