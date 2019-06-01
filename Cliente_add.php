<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clinica</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="Css/bootstrap.css" type="text/css"/>
        <link rel="stylesheet" href="Css/bootstrap.min.css" type="text/css"/>
	<link href="Css/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
        
	     <link href="Css/Login.css" rel="stylesheet" type="text/css"/>         
         <script src="Js/login.js" type="text/javascript"></script>    
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<style>
		.container {padding: 20px}
	</style>
	
</head>
<body>
    <div class="container-fluid">
            <div id="bar">
	            <div id="container">
	                <!-- Login Starts Here -->
	                <div id="loginContainer"> 
	                	<a href="#" id="loginButton"><span>Login</span><em></em></a>                        
	                    <div style="clear:both"></div>
	                    <div id="loginBox">                
	                        <form id="loginForm" method="POST" action="Validar_Login.php">
	                            <fieldset id="body">
	                                <fieldset>
	                                    <label for="username">Usuario</label>
	                                    <input type="text" name="username" id="username" />
	                                </fieldset>
	                                <fieldset>
	                                    <label for="password">Contraseña</label>
	                                    <input type="password" name="password" id="password" />
	                                </fieldset>
	                                <input type="submit" id="login" value="Ingresar" name="login" />          
                                        <a href="Cliente_add.php" type="button" id="login">Registrate</a>                        
	                            </fieldset>
	                            <!--<span><a href="#">Forgot your password?</a></span>-->
	                        </form>
	                    </div>
	                </div>
	                <!-- Login Ends Here -->
	            </div>
	        </div>   

                    <img src="Imagenes/Logo.jpg" class="img-fluid" alt="Responsive image" position=left>		

                    <!-- Barra de Menu -->   
			<nav class="nav nav-pills flex-column flex-sm-row">
			  <a class="flex-sm-fill text-sm-center nav-link active" href="Index.html">Inicio</a>
			  <a class="flex-sm-fill text-sm-center nav-link" href="Contactanos.html">Contactanos</a>
			  <a class="flex-sm-fill text-sm-center nav-link" href="Analisis_Costos.php">Analisis y Costos</a>
			  <a class="flex-sm-fill text-sm-center nav-link" href="Ubicacion.html">Ubicacion</a>
			</nav>	   
        <br>
	<div class="container">
		<div class="content">
			<h2>Datos del Cliente &raquo; Agregar datos</h2>
			<hr/>
			<?php
			if(isset($_POST['add'])){
                                $foto=$_FILES['foto']['name'];
                                $ruta=$_FILES['foto']['tmp_name'];
                                $destino="Fotos_Cliente/".$foto;
                                copy($ruta,$destino);
                                
				$dni		     = mysqli_real_escape_string($con,(strip_tags($_POST["dni"],ENT_QUOTES)));//Escanpando caracteres 
				$nombres		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombres"],ENT_QUOTES)));//Escanpando caracteres 
                                $lugar_nacimiento	 = mysqli_real_escape_string($con,(strip_tags($_POST["lugar_nacimiento"],ENT_QUOTES)));//Escanpando caracteres 
				$fecha_nacimiento	 = mysqli_real_escape_string($con,(strip_tags($_POST["fecha_nacimiento"],ENT_QUOTES)));//Escanpando caracteres 
				$direccion	     = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));//Escanpando caracteres 
				$telefono		 = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres 

				$cek = mysqli_query($con, "SELECT * FROM clientes WHERE dni='$dni'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO clientes(dni, nombres,foto_ubicacion, lugar_nacimiento, fecha_nacimiento, direccion, telefono)
															VALUES('$dni','$nombres', '$destino','$lugar_nacimiento', '$fecha_nacimiento', '$direccion', '$telefono')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
                                                                                                                
                                                }else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. DNI ya exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">   
                                    <label class="col-sm-3 control-label">Foto</label>
                                    <div class="col-sm-2">
                                    <input type="file" name="foto" id="foto" required >
                                    </div>
                                </div>
                            
				<div class="form-group">
					<label class="col-sm-3 control-label">DNI</label>
					<div class="col-sm-2">
						<input type="text" name="dni" class="form-control" placeholder="DNI" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Lugar de nacimiento</label>
					<div class="col-sm-4">
						<input type="text" name="lugar_nacimiento" class="form-control" placeholder="Lugar de nacimiento" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha de nacimiento</label>
					<div class="col-sm-4">
						<input type="text" name="fecha_nacimiento" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Dirección</label>
					<div class="col-sm-3">
						<textarea name="direccion" class="form-control" placeholder="Dirección"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Teléfono</label>
					<div class="col-sm-3">
						<input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
					</div>
				</div>						
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
                                                <a href="Index.html" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>
	<script src="Js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>

