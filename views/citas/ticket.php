<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Elefante Azul - Cita Previa</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="views\css\style.css">
    </head>
    <body>
        <div class id='ticket'>
            <ul>
                <li>Fecha = <?php echo $datos['valores']['fecha'] ?></li>
                                    
                <li>Hora de entrada = 
                    <?php
                    /**
                    * Al optar por guardar la fecha en string debo de crear una variable 
                    * tipo DateTime para aplicar los formatos, si la variable fuera ya DateTime
                    * sería simplemente así>> <?php echo $datos['valores']['entrada']-> format('h:i A') ?>.
                    * No obstante, siento que tengo mejor control de esta manera.
                    */
                        $horaEntrada=new DateTime($datos['valores']['entrada']);
                        echo $horaEntrada->format('h:i A');
                    ?>
                </li>
                <li>Hora de salida = 
                    <?php
                        $horaSalida=new DateTime($datos['valores']['salida']);
                        echo $horaSalida->format('h:i A');
                    ?>
                </li>
                <li>Nombre = <?php echo $datos['valores']['nombre'] ?></li>
                <li>Teléfono = <?php echo $datos['valores']['telefono'] ?></li>
                <li>Coche = <?php echo $datos['valores']['marca'].' '.$datos['valores']['modelo'] ?></li>
                <li>Matrícula = <?php echo $datos['valores']['matricula'] ?></li>
                <li>
                Tipo de Lavado = <?php echo $tipos->getTipo($datos['valores']['tipoLavado']); ?>
                </li>
                
                <li>Limpieza de llantas = <?php echo ($datos['valores']['llantas']==15 || $datos['valores']['llantas']=='15' ? 'Sí' : 'No') ?></li>
                <li>Precio total = <?php echo $datos['valores']['precio']?>€ </li>
                
            </ul>

            <hr>

            <a href="index.php?controller=citas&action=listado">Volver</a>

        </div>
    </body>
</html>