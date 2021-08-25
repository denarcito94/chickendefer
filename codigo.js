$(document).ready(inicio);
function inicio(){
	
	$(".botoncompra").click(anade);
	$("#carrito").load("pcarrito.php");

}
function anade(){
	var idnumero=$(this).val();
	var cantidad= $("#num"+idnumero).val();

	$("#carrito").load("pcarrito.php?p="+$(this).val()+"&cant="+cantidad);
}
