<?php
  include_once(dirname(__FILE__)."/config.php");
?>

<!------------------------------ NAVIGATION BAR (MENU)-------------------------------------->
    <header>
      <nav class="navbar navbar-inverse" >
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-briefcase"></span> Info Empleo</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
            
            <!-----------------TODOS (PUBLICO Y PRIVADO)------------------>
            <li><a href='<?php echo RUTA;?>/ver_puestos.php'>Ver Puestos</a></li>
            <li><a href='<?php echo RUTA;?>/ver_empresas.php'>Ver Empresas</a></li>


            <!-----------------LOGUEADO COMO USUARIO------------------>
            <?php
            if(isset($_SESSION['id_usuario']) && empty($_SESSION['empresaLogeada'])) {
              ?>
              <li><a href='<?php echo RUTA;?>/oferente/perfil'>Perfil</a></li>
              <li><a href='<?php echo RUTA;?>/oferente/trabajos_aplicados.php'>Mis Trabajos Aplicados</a></li>
              <li><a href='<?php echo RUTA;?>/cerrar_sesion.php'>Cerrar sesión</a></li>
            
            <!-----------------LOGUEADO COMO EMPRESA------------------>
            <?php
            } else if(isset($_SESSION['id_usuario']) && isset($_SESSION['empresaLogeada'])) {
            ?>
            <li><a href='<?php echo RUTA;?>/empresa/buscar_oferente.php'>Buscar Oferentes</a></li>
            <li><a href='<?php echo RUTA;?>/empresa/crear_puestoTrabajo.php'>Agregar Puestos</a></li>
            <li><a href='<?php echo RUTA;?>/empresa/trabajos_publicados.php'>Puestos Publicados</a></li>
            <li><a href='<?php echo RUTA;?>/cerrar_sesion.php'><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

            <!----------------- SOLO PARTE PUBLICA(no privada)------------------>
            <?php } else { ?>
              <li><a href='<?php echo RUTA;?>/empresa.php'>Empresa</a></li>
              <li><a href='<?php echo RUTA;?>/registro.php'>Registro</a></li>
              <li><a href='<?php echo RUTA;?>/login.php'><span class="glyphicon glyphicon-user"></span> Inicio de sesión</a></li>
            <?php } ?>              
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
<!------------------------------------------------------- FIN DE MENU -------------------------------------------->

