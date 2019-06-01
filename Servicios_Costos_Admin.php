<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
   echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='Index.html'>Login</a>";
exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();

echo "Su sesion a terminado,
<a href='Index.html'>Necesita Hacer Login</a>";
exit;
}
?>

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
                            <a href="Logout.php" id="loginButton"><span>-Salir-</span><em></em></a>                        
                        <div style="clear:both"></div>                    
                    </div>
                    <!-- Log<div class="container-fluid">in Ends Here -->
                </div>
            </div>  

                    <img src="Imagenes/Logo.jpg" class="img-fluid" alt="Responsive image" position=left>		

                    <!-- Barra de Menu -->   
                    <nav class="nav nav-pills flex-column flex-sm-row">
                        <a class="flex-sm-fill text-sm-center nav-link" href="admin_index.php">Empleados</a>
                        <a class="flex-sm-fill text-sm-center nav-link" href="add.php">Agregar Empleados</a>
                        <a class="flex-sm-fill text-sm-center nav-link" href="Servicios_Costos_Admin_index.php">Servicios y Costos</a>
                        <a class="flex-sm-fill text-sm-center nav-link active" href="Servicios_Costos_Admin.php">Agregar Servicios</a>
                    </nav>     
         <br>
	<div class="container">
		<div class="content">
			<h2>Datos de servicio &raquo; Agregar servicio</h2>
			<hr/>
			<?php
			if(isset($_POST['add'])){
				$codigo                  = mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));//Escanpando caracteres 
				$servicio		 = mysqli_real_escape_string($con,(strip_tags($_POST["servicio"],ENT_QUOTES)));//Escanpando caracteres 
				$costo                   = mysqli_real_escape_string($con,(strip_tags($_POST["costo"],ENT_QUOTES)));//Escanpando caracteres 
				$estado			 = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));//Escanpando caracteres 
							
				$cek = mysqli_query($con, "SELECT * FROM servicios WHERE codigo='$codigo'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO servicios(codigo, servicio, costo, estado)
															VALUES('$codigo','$servicio', '$costo', '$estado')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="codigo" class="form-control" placeholder="Código" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="servicio" class="form-control" placeholder="Servicio" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Costo</label>
					<div class="col-sm-4">
						<input type="text" name="costo" class="form-control" placeholder="Costo" required>
					</div>
                                </div>		
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-3">
						<select name="estado" class="form-control">
							<option value=""> -Seleccione- </option>
                                                        <option value="1">Habilitado</option>
							<option value="2">Deshabilitado</option>					
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="admin_index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>
	<script src="Js/bootstrap-datepicker.js"></script>	
</body>
</html>