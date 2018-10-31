<?php
//session_start();
if(!isset($_SESSION["validar"])){
  echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<?php 
if(isset($_GET["resp"])){
  if($_GET["resp"] == "ok"){
    ?>
      <div class="col-lg-12">
        Exitoooooo
      </div>
    <script type="text/javascript">
      var timer = 3;
      var idInterval = null;

      function time() {
        timer--;
        if (timer==0) {
          clearInterval(idInterval);
          window.location = "index.php?action=ver-usuarios";
        }
      }

      idInterval = setInterval(time,1000);  
    </script>
    <?php
  }
}
?>

  <div class="col-lg-4"></div>

  <div class="col-lg-4">
    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title"><i class="fa fa-user-plus" style="font-size: 36px;"></i> NUEVO USUARIO</h3>
      </div>
      <!-- /.card-header -->

      <!-- form start -->
      <form role="form" method="POST">
        <div class="card-body">   
          <label>Usuario:</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" id="usuario" name="usuario" placeholder="Usuario" required class="form-control">
          </div>
          <label>Contraseña:</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-key"></i></span>
            </div>
            <input type="password" id="PW1" name="password1" placeholder="Contraseña" required class="form-control">
          </div>
          <label>Confirmar contraseña:</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-key"></i></span>
            </div>
            <input type="password" id="PW2" name=password2" placeholder="Confirmar contraseña" required class="form-control">
          </div>

          <script type="text/javascript">
            document.getElementById("PW2").onchange = function(e){
              var PW1 = document.getElementById("PW1");
              if(this.value != PW1.value ){
                alert("Contraseñas no coinciden.");
                PW1.focus();
                this.value = "";
              }
            };
          </script>

          </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <center> 
                <button type="submit" name="GuardarUsuario" class="btn btn-outline-dark"> 
                <i class="fa fa-save"></i>  Guardar
                </button>
              </center>
            </div>
          </form>
      </div>
  </div>

  <div class="col-lg-4"></div>
<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevoUsuarioController();

?>