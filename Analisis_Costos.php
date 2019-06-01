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
         
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
         <link href="Css/Login.css" rel="stylesheet" type="text/css"/>         
         <script src="Js/login.js" type="text/javascript"></script>  
                  
              
                   
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
		  <a class="flex-sm-fill text-sm-center nav-link" href="Index.html">Inicio</a>
			  <a class="flex-sm-fill text-sm-center nav-link" href="Contactanos.html">Contactanos</a>
			  <a class="flex-sm-fill text-sm-center nav-link active" href="Analisis_Costos.php">Analisis y Costos</a>
			  <a class="flex-sm-fill text-sm-center nav-link" href="Ubicacion.html">Ubicacion</a>
		</nav>                    

        <br>
	<div class="container">
		<div class="content">
			<h2>Lista de Servicio</h2>
			<hr/>	                        

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
					<th>Código</th>
					<th>Servicio</th>                    
                                        <th>Costo</th>
                                    </tr>	
                                    
                                  </thead>  				
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
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div>
    </div>
        <center>
            <!--<p>&copy; Mistexx</p-->
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

