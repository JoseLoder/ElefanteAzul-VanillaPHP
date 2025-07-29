<?php
    if($datos['consulta'] == 'OK'){

        require_once('views/citas/ticket.php');

    }else{

?>
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
        <div id="all">
            <header>
                <img src="views\css\images\elefante-azul.svg" width="200" alt="Logo" id="logo">
            </header>
            <main> 
                <form action="index.php?controller=citas&action=add" method=post>

                    <label class="resaltado" for="nombre">Nombre</label>
                    <input type="text" name="nombre" value=<?php  $citas->mostrarValores('nombre')?>>
                    <?php $citas->mostrarErrores('nombre');?>
                    
                    <label class="resaltado" for="telefono">Teléfono</label>
                    <input type="number" name="telefono" placeholder="+34" value=<?php $citas->mostrarValores('telefono') ?>>
                    <?php $citas->mostrarErrores('telefono');?>

                    <div class="coche">

                        <label class="resaltado">Coche</label>

                        <label for="marca">Marca</label>
                        <input type="text" name="marca" value=<?php $citas->mostrarValores('marca') ?>>
                        <?php $citas->mostrarErrores('marca');?>

                        <label for="modelo">Modelo</label>
                        <input type="text" name="modelo" value=<?php $citas->mostrarValores('modelo') ?>>
                        <?php $citas->mostrarErrores('modelo');?>

                        <label for="matricula">Matrícula</label>
                        <input type="text" name="matricula" value=<?php $citas->mostrarValores('matricula') ?>>
                        <?php $citas->mostrarErrores('matricula');?>
                    </div>


                    <label class="resaltado">Tipo de lavado</label>
                    <?php
                        $tipos->mostrarTipos($datos['valores']['tipoLavado']);
                        $citas->mostrarErrores('tipoLavado');
                    ?>

                    <div>
                        <label for="llantas">Limpieza de llantas (15€)</label>
                        <input type="checkbox" name="llantas" value="15" <?php echo ($datos['valores']['llantas']==15 ? 'checked' : '' )?>>
                    </div>

                    <label class="resaltado" for="fecha">Fecha</label>
                    <input type="text" name="fecha" placeholder="dd/mm/yyyy" value=<?php $citas->mostrarValores('fecha') ?>>
                    <?php $citas->mostrarErrores('fecha');?>

                    <button class="elementoDestacado" type="submit">Crear pedido</button>

                </form>
            </main>
        </div>
    </body>
</html>
<?php
        }