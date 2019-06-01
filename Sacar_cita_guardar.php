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
                    
        <br>
	<div class="container">
		<div class="content">
			<h2>Lista de servicios &raquo; Guardar Cita</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$code= mysqli_real_escape_string($con,(strip_tags($_GET["code"],ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM servicios WHERE codigo='$code'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: Sacar_cita.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$dni        = mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));//Escanpando caracteres 
				$servicio   = mysqli_real_escape_string($con,(strip_tags($_POST["servicio"],ENT_QUOTES)));//Escanpando caracteres 
				$fecha      = mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));//Escanpando caracteres 
				$costo      = mysqli_real_escape_string($con,(strip_tags($_POST["costo"],ENT_QUOTES)));//Escanpando caracteres 				
				
                                $cek = mysqli_query($con, "SELECT * FROM citas WHERE dni='$dni' AND fecha='$fecha'");
				if(mysqli_num_rows($cek) == 0){
                                    $insert = mysqli_query($con, "INSERT INTO citas(dni, servicio, fecha, costo)
                                            VALUES('$dni','$servicio', '$fecha', '$costo')") or die(mysqli_error());
                                    if($insert){
                                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
                                    }else{
                                            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
                                    }
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. Cita ya reservada!</div>';
				}	 
			}
			
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">DNI</label>
					<div class="col-sm-2">
						<input type="text" name="codigo" value="<?php echo $_SESSION["Codigo"]; ?>" class="form-control"  required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Servicio</label>
					<div class="col-sm-4">
						<input type="text" name="servicio" value="<?php echo $row ['servicio']; ?>" class="form-control"  required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha de atencion</label>
					<div class="col-sm-4">
						<input type="text" name="fecha" class="input-group date form-control" date="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" required>
					</div>
				</div>	
                            
                                <div class="form-group">
					<label class="col-sm-3 control-label">Costo</label>
					<div class="col-sm-4">
						<input type="text" name="costo" value="<?php echo $row ['costo']; ?>" class="form-control"  required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar reserva">
                                                <a href="Sacar_cita.php" class="btn btn-sm btn-danger">Volver</a>
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
