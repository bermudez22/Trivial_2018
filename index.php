<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>PRUEBA DE PHP CON BOOTSTRAP</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <div class ="row">
                <div class="col-4">
                    <button id="boton1" class="btn btn-primary">Primary</button>
                </div>
                <div class="col-4">
                    <input id ="cajaNombre" name="usuario_nombre" type="text" placeholder="Usuario">                </div>
                <div class="col-4"></div>
            </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
    <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
    
    <script>
         // document ready se ejecuta cuando toda la página se ha cargado correctamente
        $(document).ready(function(){
            $('#cajaNombre').hide();
        });
        
        $('#boton1').click(function(){
            console.log("aqui si que llega");
            $('#cajaNombre').show(200);
        });
    </script>
</html>
