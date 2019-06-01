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
			<h2>Lista de Citas</h2><hr/>	
                                                                      
			<div class="table-responsive">
			<table class="table table-striped table-hover" id="tabla">                            
                                <thead>
                                    <tr>
                                      <td colspan="4">
                                        <input id="buscar" type="text" class="form-control" placeholder="Escriba algo para filtrar" />
                                      </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>No</th>
					<th>DNI</th>
					<th>Servicio</th>                    
                                        <th>Costo</th>
                                    </tr>	
                                    
                                  </thead>                           
                               		                                
                                <?php       
                                
                                $sql = mysqli_query($con, "SELECT * FROM citas");				
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td><a href="Lista_Cliente_Detalle_Reservas.php?nik='.$row['dni'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['dni'].'</td>
							<td>'.$row['servicio'].'</a></td>
                                                        <td>'.$row['costo'].'</td>                                                        				
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
                            <div class="text-right"> 
                                <a href="Reservas_index.php" class="btn btn-sm btn-primary">Regresar</a>   
                        </div>
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
         document.querySelector("#buscar").onkeyup = function(){
        $TableFilter("#tabla", this.value);
    }
    
    $TableFilter = function(id, value){
        var rows = document.querySelectorAll(id + ' tbody tr');
        
        for(var i = 0; i < rows.length; i++){
            var showRow = false;
            
            var row = rows[i];
            row.style.display = 'none';
            
            for(var x = 0; x < row.childElementCount; x++){
                if(row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1){
                    showRow = true;
                    break;
                }
            }
            
            if(showRow){
                row.style.display = null;
            }
        }
    }</script>
</body>
</html>
