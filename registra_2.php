<html>
    <link rel="shortcut icon" type="image/x-icon" href="image/trivial.png"
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <title>Trivial</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/fontawesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/regular.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/solid.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body style="background-color: #155724; color:white; ">

        <div class="container "  id="principal">
            <div>
                <img src="trivialmove.gif"  class="img-thumbnail" ></img>
                <div class="col-11"> 
                </div>
                <div class="col-1">    
                </div>                 
            </div>
            <div class ="row">
                <div class="col-4">
                </div>
                <div class="col-4">
                    <br/>
                        <input id ="cajaNombre" class="form-control" type="text" placeholder="Usuario" required="required">
                        <br/>
                        <input id ="cajaPassword" class="form-control" type="password" placeholder="Contraseña">
                        <br/>
                        <button id="boton1" class="btn btn-primary btn-block" type="submit"><img src="image/silueta-de-usuario.png" height="25" width="20">Iniciar Sesion</img></button>
                        <br/>
                        <p>¿No tienes cuenta?</p>
                        <button id="boton1" class="btn btn-primary btn-block"  onclick="registra();" type="submit"><img src="image/flecha2.gif" height="25" width="20" >Registrate</img></button>
                        
             
    </body>
                </html>


<?php

include ('misFunciones.php');

function limpiaPalabra($palabra){
    //filtro muy básico para evitar la inyeccion SQL
    $palabra = trim($palabra, "'");
    $palabra = trim($palabra, " ");
    $palabra = trim($palabra, "-");
    $palabra = trim($palabra, "`");
    $palabra = trim($palabra, '"');
    return $palabra;
}

$mysqli = conectaBBDD();

 $cajaNombre = limpiaPalabra($_POST['cajaNombre']);
 
 $cajaPassword = limpiaPalabra($_POST['cajaPassword']);

$passwordEncriptada =  password_hash($cajaPassword, PASSWORD_BCRYPT);



 $resultadoQuery = $mysqli -> query("INSERT INTO usuarios (`idUsuario`, `nombreUsuario`, `userPass`)  VALUES (NULL, '$cajaNombre', '$passwordEncriptada') ");
 

 
 $numUsuarios = $mysqli -> affected_rows;

if ($numUsuarios > 0){
    echo ('<div class="alert alert-success" role="alert"> SE HA AÑADIDO CORRECTAMENTE AL USUARIO '.$cajaNombre.' </div>');
}
else{
     echo ('<div class="alert alert-danger" role="alert"> NO SE HA PODIDO AÑADIR AL USUARIO '.$cajaNombre.' </div>');
}

 
