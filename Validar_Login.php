<?php
session_start();
?>

<?php
include("conexion.php");

				$usuario = $_POST['username'];
				$pw = $_POST['password'];
				$log = mysqli_query($con,"SELECT * FROM empleados WHERE nombres='$usuario' AND codigo='$pw'");
				if (mysqli_num_rows($log)>0) {
					if (mysqli_num_rows($log)>0) {
					$row = mysqli_fetch_array($log);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['start'] = time();
                                        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);					
                                        $_SESSION["Usuario"] = $row['nombres']; 
                                        $_SESSION["Codigo"] = $row['codigo']; 
				  	//echo 'Iniciando sesión para '.$_SESSION['Usuario'].' <p>';					
                                            if($row['puesto']=="Gerente"){
                                                echo '<script> window.location="admin_index.php"; </script>';                                                     
                                            }else {echo '<script> window.location="Reservas_index.php"; </script>';}
                                        }    
                                        else{
                                                echo '<script> alert("Usuario o contraseña incorrectos.");</script>';
                                                echo '<script> window.location="Index.html"; </script>';
                                        }

				}else {
                                    $log = mysqli_query($con,"SELECT * FROM clientes WHERE nombres='$usuario' AND dni='$pw'");
                                    if (mysqli_num_rows($log)>0) {
					$row = mysqli_fetch_array($log);
                                        $_SESSION['loggedin'] = true;
                                        $_SESSION['start'] = time();
                                        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);					
                                        $_SESSION["Usuario"] = $row['nombres']; 
                                        $_SESSION["Codigo"] = $row['dni']; 
				  	//echo 'Iniciando sesión para '.$_SESSION['Usuario'].' <p>';
					echo '<script> window.location="Cliente_index.php?nik='.$row['dni'].'"; </script>';    
                                        
                                        }
                                        else{
                                                echo '<script> alert("Usuario o contraseña incorrectos.");</script>';
                                                echo '<script> window.location="Index.html"; </script>';
                                        }
                                }
				
mysqli_close($con); 
?>