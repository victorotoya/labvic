<?php
/*Datos de conexion a la base de datos*/

$db_host = "db718954686.db.1and1.com";
$db_user = "dbo718954686";
$db_pass = "123456789";
$db_name = "db718954686";

/*
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "sagitario20";
$db_name = "proyecto_clinica";*/

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
}

?>



