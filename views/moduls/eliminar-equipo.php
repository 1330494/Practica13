<?php 

if(isset($_GET["idEquipo"])){
	$idEquipo = $_GET["idEquipo"];
}


if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deleteEquipoController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idEquipo" id="idEquipo" value="<?php echo $idEquipo; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idEquipo').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar este equipo?");

	if (resp && confirmed!="true") {
			alert("Eliminado correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-equipo&idEquipo="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-equipos";
	}

</script>
<?php 



?>