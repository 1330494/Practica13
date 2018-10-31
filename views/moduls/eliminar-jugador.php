<?php 

if(isset($_GET["idJugador"])){
	$idJugador = $_GET["idJugador"];
}


if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deleteJugadorController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idJugador" id="idJugador" value="<?php echo $idJugador; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idJugador').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar este jugador?");

	if (resp && confirmed!="true") {
			alert("Eliminado correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-jugador&idJugador="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-jugadores";
	}

</script>
<?php 



?>