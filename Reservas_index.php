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
			<h2>Reservas</h2>
			<hr/>	
		
			<br />			
				<?php	                                
                                $nik =  $_SESSION["Codigo"];	
                                $sql = mysqli_query($con, "SELECT * FROM empleados WHERE codigo='$nik'");
                                
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
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
					<th>Encargado</th>
					<td><?php echo $row['nombres']; ?></td>
				</tr>				
			</table>
                        
                        <table class="table table-striped table-condensed">                                                         
				<tr>					
                                        <th><Center>Ver Citas</center><th>
                                        <th><Center>Ver Pacientes</center></th>
				</tr>	
                                <tr>					
					<td><Center><a href="Listas_Reservas_Reservas.php"  title="Ver Citas" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></center><td>
                                        <td><Center><a href="Lista_Cliente_Reservas.php"  title="Ver Clientes" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></center></td>
				</tr>	
			</table>            
		</div>               
        </div>
        
        
	</div>
        <center>
            <!--<p>&copy; Mistexx <?php echo date("Y");?></p-->
		</center>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>
</body>
</html>

