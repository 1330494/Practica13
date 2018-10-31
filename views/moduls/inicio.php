<?php
//session_start();
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}
?>

<div class="row" style="height: 10px;width: 100%;"></div>

<div class="col-md-12">

<?php 
$control_contadores = new Controlador_MVC();
$contadores = $control_contadores->DataBaseTablesCounterController(); 
?>
  <div class="row">
        <div class="col-sm-12 ">
          <center>
            <h1 class="text-danger">Concentrado del Sistema</h1>
          </center>
          <br>
        </div>
  </div>
</div>

<div class="col-md-12">
  <div class="row">
        <div class="col-lg-3 col-6"></div> <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><h3><?php echo $contadores['equipos']; ?></h3></h3>

                <p>Equipos</p>
              </div>
              <div class="icon">
                <i class="fa fa-street-view"></i>
              </div>
              <a href="index.php?action=ver-equipos" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><h3><?php echo $contadores['jugadores']; ?></h3></h3>

                <p>Jugadores</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="index.php?action=ver-jugadores" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6"></div> <!-- ./col -->
  </div>
</div>

<div class="col-md-12">
  <div class="row">
    <div class="col-lg-3 col-6"></div> <!-- ./col -->

    <div class="col-lg-3 col-6">
            <!-- medium box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><h3><?php echo $contadores['categorias']; ?></h3></h3>

                <p>Diciplinas</p>
              </div>
              <div class="icon">
                <i class="fa fa-soccer-ball-o fa-spin"></i>
              </div>
              <a href="index.php?action=ver-disciplinas" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3><h3><?php echo $contadores['usuarios']; ?></h3></h3>

                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="index.php?action=ver-usuarios" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
    </div>
          <!-- ./col -->
    <div class="col-lg-3 col-6"></div> <!-- ./col -->
  </div>
</div>
