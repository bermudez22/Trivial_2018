<?php
include ('misFunciones.php');

$mysqli = conectaBBDD();

 $cajaNombre = $_POST['cajaNombre'];
 
 $cajaPassword = $_POST['cajaPassword'];



//echo 'Has escrito el usuario: '.$cajaNombre.' y la contraseña: '.$cajaPassword; 
 
 $resultadoQuery = $mysqli -> query("SELECT * FROM preguntas");