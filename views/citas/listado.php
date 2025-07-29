<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Elefante Azul - Cita Previa</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="views\css\style.css">
    </head>
    <body>
        <div id="all">
            <header>
            <img src="views\css\images\elefante-azul.svg" width="200" alt="Logo" id="logo">
            </header>
            <main>
                <?php

                    if(!empty($registros))
                    {
                        ?>
                        <table>
                            <!--Creamos la cabecera de la tabla-->
                            <thead>
                                </tr>
                                    <th>Fecha</th>
                                    <th>Hora entrada</th>
                                    <th>Hora salida</th>
                                    <th>Modelo</th>
                                    <th>Matrícula</th>
                                    <th>Lavado</th>
                                    <th>Precio</th>
                                    <th>Contacto</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //Recorremos los registros con un for tradicional.
                            for ($i=0; $i < count($registros); $i++) {
                                //Abrimos una fila ya que cada vuelta del for indica un regustro
                                echo '<tr>';
                                /**
                                 * Recorremos todos los campos del registro, y por cada campo 
                                 * creamos una celda, yo las he creado con funciones para no
                                 * tener que estar constantemente con el echo abriendo etiquetas
                                 * y cerrando. Además así queda más limpio.
                                 */
                                $fechaEntrada= new DateTime($registros[$i]['entrada']);
                                hacerCelda($fechaEntrada ->format('d/m/Y'));
                                hacerCelda($fechaEntrada ->format('h:i A'));
                                $fechaSalida= new DateTime($registros[$i]['salida']);
                                hacerCelda($fechaSalida ->format('h:i A'));
                                $modelo = explode(" ", $registros[$i]['coche']);
                                hacerCelda($modelo[1]);
                                hacerCelda($registros[$i]['matricula']);
                                conllantas($registros[$i]['tipo_lavado'], $registros[$i]['llantas']==15);
                                hacerCelda($registros[$i]['precio'].' €');
                                mostrarContacto($registros[$i]['nombre'], $registros[$i]['telefono']);
                                echo '</tr>';

                            }
                            echo '</tbody>';    
                                        
                        echo '</table>';
                    }else
                    {
                        echo '<h1>No existe ningún registro</h1>';
                    }
                ?>
            </main>
        </div>
    </body>
</html>
<?php
function hacerCelda($valor){
  echo '<td>'.$valor.'</td>';
}
function conllantas($valor,$muestra){
    $valorOriginal = $valor;
    if(is_array($valor) || is_object($valor)){
        foreach ($valor as $tipo) {
            if($tipo['id'] == $valorOriginal){
                $valor = $tipo['descripcion'];
                break;
            }
        }
    }
    if($muestra){
        echo '<td>'.$valor.' <img title="Con lavado de llantas." src="https://www.juntadeandalucia.es/educacion/gestionafp/datos/tareas/DAW/DWES_42625171/2023-24/DAW_DWES_2_2023-24_Individual__650793/rueda.png" alt="Con Limpieza de llantas" width="16" height="16" style="margin: 0px; padding: 0px;"></td>';
    }else{
        hacerCelda($valor);
    }
}


function mostrarContacto($nombre,$telefono){
    echo'
        <td>
            <span style=color:black;margin:15px title="Nombre: '.$nombre.', Teléfono: '.$telefono.'." class="material-symbols-outlined">
                phone_in_talk
            </span>
        </td>
    ';
}
?>