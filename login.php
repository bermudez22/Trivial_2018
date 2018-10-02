<?php
include ('misFunciones.php');

$mysqli = conectaBBDD();

 $cajaNombre = $_POST['cajaNombre'];
 
 $cajaPassword = $_POST['cajaPassword'];


//echo 'Has escrito el usuario: '.$cajaNombre.' y la contraseña: '.$cajaPassword; 
 
 $resultadoQuery = $mysqli -> query("SELECT * FROM usuarios 
                                WHERE nombreUsuario='$cajaNombre' AND userPass='$cajaPassword' ");
 
 $numUsuarios = $resultadoQuery -> num_rows;
 
//for ( $i = 0; $i < $numPreguntas; $i++){
//    $r = $resultadoQuery -> fetch_array();
//    echo $r['nombreUsuario'] .'<br/>';
//}

 if ($numUsuarios > 0){
     //muestro la pantalla de la aplicación
     require 'app.php';
 }
 else {
     //muestro una pantalla de error
     require 'error.php';
 }
 
 
