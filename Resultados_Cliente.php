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
			<h2>Cliente</h2>					
                        <?php                        
                        $dni_cliente=  mysqli_real_escape_string($con,(strip_tags($_GET["dni_cliente"],ENT_QUOTES)));       
                        $sql = mysqli_query($con, "SELECT * FROM archivos WHERE id='$dni_cliente'");			
                        $row = mysqli_fetch_assoc($sql);
			?>
                        
                        <table class="table table-striped table-condensed">                                                            
				<tr>
					<th width="20%">DNI</th>
					<td><?php echo $dni_cliente; ?></td>
				</tr>			
			</table>
                        
                        <h2>Resultados</h2>
                        <table class="table table-striped table-condensed">     
                                <tr>
                                        <th>No</th>                                       
					<th>Resultado</th>
					<th>Accion</th>                    
                                        
                                </tr>	

                                <?php
				
                                $sql = mysqli_query($con, "SELECT * FROM archivos where id='$dni_cliente'");
				
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>                                                        
							<td>'.$row['archivo_ubicacion'].'</td>
							<td>
                                                        <a href="'.$row['archivo_ubicacion'].'"><span class="glyphicon glyphicon-download" aria-hidden="true"></span> Descarga</a>
                                                       
                                                        </td>                                			
						</tr>
						';
						$no++;
					}
				}
				?>	                                
                        </table>                                                 
                                                
                        <div class="text-right"> 
                            <a href="Cliente_index.php" class="btn btn-sm btn-primary">Regresar</a>   
                        </div>
                        
                         
		</div>                
        </div>
    </div>
        <center>
            <!--<p>&copy; Mistexx <?php echo date("Y");?></p-->
		</center>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="Js/bootstrap.min.js"></script>             
        
        <script>
        function formReset()
        {
        document.getElementById("Archivos_subir").reset();
        }
        </script>
        
</body>
</html>



    




