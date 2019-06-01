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
	<div class="container">
		<div class="content">
			<h2>Datos del Cliente &raquo; Perfil</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			
			$sql = mysqli_query($con, "SELECT * FROM clientes WHERE dni='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: Lista_Clientes.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}	
			?>
			<table class="table table-striped table-condensed"> 
                            <td colspan="2"><center>                    
                            <img src="<?php echo $row['foto_ubicacion'];?>" width="120px" height="180px"></center>  </td>
                        </table>
			<table class="table table-striped table-condensed">                                                            
				<tr>
					<th width="20%">DNI</th>
					<td><?php echo $row['dni']; ?></td>
				</tr>
				<tr>
					<th>Nombre</th>
					<td><?php echo $row['nombres']; ?></td>
				</tr>
				<tr>
					<th>Lugar y Fecha de Nacimiento</th>
					<td><?php echo $row['lugar_nacimiento'].', '.$row['fecha_nacimiento']; ?></td>
				</tr>
				<tr>
					<th>Dirección</th>
					<td><?php echo $row['direccion']; ?></td>
				</tr>
				<tr>
					<th>Teléfono</th>
					<td><?php echo $row['telefono']; ?></td>
				</tr>
                                                                
			</table>              
                                              
                        <div class="text-right">
                        <a href="Lista_Clientes.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Regresar</a>
                        <a href="Resultados.php?dni_cliente=<?php echo $row['dni'];?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Resultados</a>
                        </div>
		</div>
	</div>
    </div>      
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>
</body>
</html>