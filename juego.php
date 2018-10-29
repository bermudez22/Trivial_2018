<?php
session_start();
//capturo los valores de los parámetros que me han sido pasados
//desde app.php
include ('misFunciones.php');
$vidas = $_POST['vidas'];
$correctas = $_POST['correctas'];
$tema = $_POST['tema'];

$mysqli = conectaBBDD();
$resultadoQuery = $mysqli -> query("SELECT * FROM preguntas WHERE tema ='$tema' ");
$numPreguntas = $resultadoQuery -> num_rows;
 
//declaro un array en php para guardar el resultado de la query
$listaPreguntas = array();

//cargo todas las filas del resultado de la query en el array
    for ($i = 0; $i < $numPreguntas; $i++){
        $r = $resultadoQuery -> fetch_array(); //leo una fila del resultado de la query
        $listaPreguntas[$i][0] = $r['numero'];
        $listaPreguntas[$i][1] = $r['enunciado']; 
        $listaPreguntas[$i][2] = $r['r1']; 
        $listaPreguntas[$i][3] = $r['r2']; 
        $listaPreguntas[$i][4] = $r['r3']; 
        $listaPreguntas[$i][5] = $r['r4']; 
        $listaPreguntas[$i][6] = $r['correcta'];
    }
    
 $preguntaActual = rand(0, $numPreguntas-1);

?>
<div>
    <p></p>
    <p><a  class="btn btn-block btn-dark disabled" ><?php echo $_SESSION['nombreUsuario']?>, demuestra que estás listo para la EVAU </a></p>
    <p><a  class="btn btn-block btn-warning" style="background-color:transparent;" onclick="volver();"><span class="fas fa-arrow-left" ></span> Volver al Menú</a></p>
    
    <p><a id="sigue1" class="btn btn-block btn-primary" ><?php echo $tema;?></a></p>
    
        <div id="cajatiempo" style="height: 30px;" >
            <div id="tiempo" class="progress-bar progress-bar-striped bg-success" style="width: 0%;"></div>
        </div>
    <p></p>
    <p><a id="enunciado" class="btn btn-block btn-warning " style="white-space: normal;"></a></p>
    
    <p><a id="resp1"  class="btn btn-block btn-success" style="white-space: normal;"></a></p>
    <p><a id="resp2"  class="btn btn-block btn-success" style="white-space: normal;"></a></p>
    <p><a id="resp3"  class="btn btn-block btn-success" style="white-space: normal;"></a></p>
    <p><a id="resp4"  class="btn btn-block btn-success" style="white-space: normal;"></a></p>
</div>

<script>
    function volver(){
        $('#principal').load('app.php');
    }
    var progreso;
    var segundo = 0;
    iniciaTemporizador();
    
    //cargo el array php de preguntas en una variable javascript
    var listaPreguntas = <?php echo json_encode($listaPreguntas); ?>;
    //calculo un numero aleatorio
    var numeroPregunta = calculaNumeroPregunta();
    //dibujo los textos en los botones correspondientes
    sigue();
 
 
function sigue(){
    $("[id*='resp']").removeClass("btn-dark").removeClass("btn-secondary").removeClass("btn-danger").addClass("btn-success");
    iniciaTemporizador();
    numeroPregunta = calculaNumeroPregunta();
    $('#enunciado').text(listaPreguntas[numeroPregunta][1]);
    $("[id*='resp']").prop("onclick", null).off("click");
    $('#resp1').text(listaPreguntas[numeroPregunta][2]).click(function(e){cambiaPregunta(e,1);});
    $('#resp2').text(listaPreguntas[numeroPregunta][3]).click(function(e){cambiaPregunta(e,2);});
    $('#resp3').text(listaPreguntas[numeroPregunta][4]).click(function(e){cambiaPregunta(e,3);});
    $('#resp4').text(listaPreguntas[numeroPregunta][5]).click(function(e){cambiaPregunta(e,4);});
 }
 
function cambiaPregunta(e,num){
     e.stopImmediatePropagation();
     var correcta = listaPreguntas[numeroPregunta][6];
     //deshabilita los clicks en los botones
     $("[id*='resp']").prop("onclick", null).off("click");
     //agrega el click al boton que se ha pulsado, para seguir la partida
     $("#resp"+num).click(function(e){e.stopImmediatePropagation();sigue();});
     detieneTemporizador();
     if (num == correcta){
        //cambia a gris las respuestas incorrectas   
        $("[id*='resp']").removeClass("btn-success").addClass("btn-secondary");
        //, y a verde la correcta 
        $("#resp"+num).removeClass("btn-danger").addClass("btn-success");
        $("#resp"+num).append("   CORRECTO! pulsa para seguir");
     }
     else {
        $("[id*='resp']").removeClass("btn-success").addClass("btn-danger");
        $("#resp"+num).removeClass("btn-danger").addClass("btn-dark").append("   INCORRECTO! pulsa para seguir");
        $("#resp"+correcta).removeClass("btn-danger").addClass("btn-success");
     }
 }
 
 

function detieneTemporizador(){
    clearInterval(progreso);
} 
function iniciaTemporizador(){
        //temporizador de la barra
    segundo = 0;
    $("#tiempo").width(0).text("");
    clearInterval(progreso);
    progreso = setInterval(function(){
        var caja = $("#cajatiempo");
        var tiempo = $("#tiempo");
        if (tiempo.width() >= caja.width()){
            clearInterval(progreso);
            segundo = 0;
        }
        else{
            tiempo.width(tiempo.width() + caja.width()/10);
            segundo++;
        }
        //cambia el color de la barra dependiendo del segundo en que está
        if (segundo < 5){
            tiempo.removeClass("bg-warning").removeClass("bg-danger").addClass("bg-success");
        }
        else if (segundo < 8){
            tiempo.removeClass("bg-success").addClass("bg-warning");
        }
        else {
            tiempo.removeClass("bg-warning").addClass("bg-danger");
        }
        tiempo.text(segundo);
    }, 3600);
    
} 


function calculaNumeroPregunta(){
    return Math.floor(Math.random() * listaPreguntas.length) ;
}

</script>    