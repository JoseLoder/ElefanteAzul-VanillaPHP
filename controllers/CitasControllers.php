<?php

spl_autoload_register(function ($nombre_clase) {
    include  'models/' . $nombre_clase . '.php';
});


class CitasController{
    public static $titulo = 'Mi MVC';

    static function listado(){
        //Creamos un objeto Citas, lo que creara nuestro array de datos vacios.
        $citas = new CitasModel();
        //Creamos un objeto Tipos, Lo que cargará los tipos de mi base de datos a la propiedad $tablaTipos de mi objeto tipos.
        $tipos = new TiposModel();
        //declaramos el array de registros para almacenar el resultado de la función listado.
        $registros= array();
        $registros = $citas->listado();

        //Con este bucle lo que consigo es reescribir la variable que almacena la id del tipo de lavado sustituyendola por la descripción.
        for ($i=0; $i < count($registros) ; $i++) { 
            $newRegistro = $tipos->getTipo($registros[$i]['tipo_lavado']);

            $registros[$i]['tipo_lavado']=$newRegistro;
            
        }

        require_once('views/citas/listado.php');
    }

    static function add(){
        $citas = new CitasModel();
        $tipos = new TiposModel();
        $citas->setData($_POST,);
        //A la función add le paso la tabla tipos para hacer comprobaciones necesarias con el objeto cita.
        $citas->add($tipos->getTipos());
        $datos = $citas->getData();

        if($datos['consulta'] == 'OK')
        {
            /***
             * Mi intención en esta condicional radicaba en crear un header que por una variable $_GET 
             * y le pasara el id de la cita al servidor y me devolviera los datos de esa cita mostrandolos en el ticket.
             * En el enrrutador creé un action con el nombre ticket para desenvocarlo todo pero no hubo manera.
             */
        }
        
        require_once("views/citas/add.php");
    }

    
    //static function ticket($id){
      //  $citas = new CitasModel();
        //$datos=$citas->buscarCita($id);
        //require_once("views/citas/ticket.php");
    //}

}