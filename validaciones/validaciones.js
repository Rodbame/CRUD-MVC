
function valcantidad{

	alert("hola");

	var cantidad = document.getElementById("txtcantidad").value;
	if (cantidad < 1) {
		alert("La cantidad no puede ser negativa");
		return false;
	}

	return true;
}