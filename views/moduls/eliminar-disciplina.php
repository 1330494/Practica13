<?php 

if(isset($_GET["idDisciplina"])){
	$idDisciplina = $_GET["idDisciplina"];
}


if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new Controlador_MVC();
	$eliminar -> deleteCategoriaController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idDisciplina" id="idDisciplina" value="<?php echo $idDisciplina; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idDisciplina').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar esta disciplina?");

	if (resp && confirmed!="true") {
			alert("Eliminada correctamente.");
			var timer = 1;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=eliminar-disciplina&idDisciplina="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);			
		
	}else{
		window.location = "index.php?action=ver-disciplinas";
	}

</script>
<?php 



?>