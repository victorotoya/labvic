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
		.container {padding: 00px}                
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
			<h2>Lista de Servicio</h2>
			<hr/>	
                        
			<br />                       
                                                
			<div class="table-responsive">
			<table class="table table-striped table-hover" id="tabla">
				<tr>
                                        <th>No</th>
					<th>Código</th>
					<th>Servicio</th>                                        
                                        <th>Costo</th>                                      
                                        <th>Acciones</th>
				</tr>                   

				<?php
				
                                $sql = mysqli_query($con, "SELECT * FROM servicios where estado='1'");
				
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['codigo'].'</td>
							<td>'.$row['servicio'].'</td>                                                        
                                                        <td>'.$row['costo'].'</td>                                                               
                                                <td>
                                                        <a href="Sacar_cita_guardar.php?code='.$row['codigo'].'" title="Sacar Cita" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>							</td>
							
						</tr>
						';
						$no++;
					}
				}
				?>
                                
			</table>
                            <div class="text-right"> 
                                    <a href="Cliente_index.php" title="Volver" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Volver</a>
                                </div>
                            </div>
		</div>
	</div>
    </div>
        
    
    
        <center>
            <!--<p>&copy; Mistexx</p-->  
        <script src="Js/bootstrap-datepicker.js"></script>       
	</center>
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


