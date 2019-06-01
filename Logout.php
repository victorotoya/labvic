<?php

session_start();
unset ($SESSION['Usuario']);
session_destroy();
header('Location: http://atenergysac.com/Index.html');
//header('Location: http://localhost:8000/Index.html');
?>
