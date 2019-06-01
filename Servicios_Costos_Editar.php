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
                  <a class="flex-sm-fill text-sm-center nav-link active" href="Servicios_Costos_Admin_index.php">Servicios y Costos</a>
                  <a class="flex-sm-fill text-sm-center nav-link" href="Servicios_Costos_Admin.php">Agregar Servicios</a>
		</nav>     
        <br>
	<div class="container">
		<div class="content">
			<h2>Datos del empleados &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM servicios WHERE codigo='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: Servicios_Costos_Admin_Index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$codigo		     = mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));//Escanpando caracteres 
				$servicio		     = mysqli_real_escape_string($con,(strip_tags($_POST["servicio"],ENT_QUOTES)));//Escanpando caracteres 
				$costo		 = mysqli_real_escape_string($con,(strip_tags($_POST["costo"],ENT_QUOTES)));//Escanpando caracteres 
				$estado			 = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));//Escanpando caracteres  
				
				$update = mysqli_query($con, "UPDATE servicios SET codigo='$codigo', servicio='$servicio', costo='$costo', estado='$estado' WHERE codigo='$nik'") or die(mysqli_error());
				if($update){
					header("Location: Servicios_Costos_Editar.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="codigo" value="<?php echo $row ['codigo']; ?>" class="form-control" placeholder="Codigo" required>
					</div>
				</div>
                            
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="servicio" value="<?php echo $row ['servicio']; ?>" class="form-control" placeholder="Servicio" required>
					</div>
				</div>			
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Dirección</label>
					<div class="col-sm-3">
						<input type="text" name="costo" value="<?php echo $row ['costo']; ?>" class="form-control" placeholder="Costo" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-3">
						<select name="estado" class="form-control">
							<option value="">- Selecciona estado -</option>
                                                        <option value="1" <?php if ($row ['estado']==1){echo "selected";} ?>>Habilitado</option>
							<option value="2" <?php if ($row ['estado']==2){echo "selected";} ?>>Deshabilitado</option>
						</select> 
					</div>
                   
                                </div>
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
                                                <a href="Servicios_Costos_Admin_index.php" class="btn btn-sm btn-danger">Cancelar</a>
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