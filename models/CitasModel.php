<?php



class CitasModel extends Bd {

    private $conexion;
    private $datos;

    public function __construct()
    {
        $this->conexion = new PDO('mysql:host=localhost;dbname='.$this->bbdd, $this->username, $this->password);

        $this->datos = array();
        $this->datos['valido'] = true;
        $this->datos['errores'] = array();
        $this->datos['consulta'] = array();
        $this->datos['valores'] = array();
        $this->datos['valores']['primeraVez'] = true;
        $this->datos['valores']['id']='';
        $this->datos['valores']['entrada']=0;
        $this->datos['valores']['salida']=0;
        $this->datos['valores']['nombre']='';
        $this->datos['valores']['telefono']='';
        $this->datos['valores']['marca']='';
        $this->datos['valores']['modelo']='';
        $this->datos['valores']['coche']='';
        $this->datos['valores']['matricula']='';
        $this->datos['valores']['tipoLavado']='';
        $this->datos['valores']['llantas']=0;
        $this->datos['valores']['fecha']='';
        $this->datos['valores']['precio']=0;
    }

    public function setData($data){

        if(!empty($data)){


            $this->datos['valores']['primeraVez'] = false;


            $this->datos['valores']['id'] = isset($data['id']) ? $data['id'] : '';

            $this->datos['valores']['nombre'] = isset($data['nombre']) ? $data['nombre'] : '';

            $this->datos['valores']['telefono'] = isset($data['telefono']) ? $data['telefono'] : '';

            $this->datos['valores']['marca'] = isset($data['marca']) ? $data['marca'] : '';

            $this->datos['valores']['modelo'] = isset($data['modelo']) ? $data['modelo'] : '';

            $this->datos['valores']['coche'] = isset($data['coche']) ? $data['coche'] : '';

            $this->datos['valores']['matricula'] = isset($data['matricula']) ? $data['matricula'] : '';

            $this->datos['valores']['tipoLavado'] = isset($data['tipoLavado']) ? $data['tipoLavado'] : '';

            $this->datos['valores']['llantas'] = isset($data['llantas']) ? $data['llantas'] : '';

            $this->datos['valores']['fecha'] = isset($data['fecha']) ? $data['fecha'] : '';

            $this->datos['valores']['precio'] = isset($data['precio']) ? $data['precio'] : '';
        }else{

            $this->datos['valores']['primeraVez']=true;
        }
        
    }

    public function getTipoLavado(){
        return $this->datos['valores']['tipoLavado'];
    }

    public function getData(){

        return $this->datos;
    }
    

    public function add($tablaTipos){
        $this->validar();

        if($this->datos['valido']==true){

            //gracias al argumento de la funcion con el que le pasamos la tabla tipos podemos hacer lo siguiente, que consiste en obtener el precio y el tiempo del tipo de lavado. 

            if(!empty($tablaTipos)){
                foreach($tablaTipos as $tipo){
                    if($tipo['id'] == $this->datos['valores']['tipoLavado'] && !empty($this->datos['valores']['tipoLavado'])){
                        //Aquí comprobamos que sean número para pasarlos a entero sin problemas.
                        if(is_numeric($tipo['precio']) && (is_numeric($tipo['tiempo']))){
                            $this->datos['valores']['precio'] = intval($this->datos['valores']['precio']) + intval($tipo['precio']);
                            $this->datos['valores']['salida'] = intval($this->datos['valores']['salida']) + intval($tipo['tiempo']);
                        }
                    }
                    
                }
            }

            $this->datos['valores']['id']= substr(bin2hex(openssl_random_pseudo_bytes(36)), 0, 36);
            
            //Configuraciones previas a la consulta añadimos el precio de la llantas y el tiempo que corresponda, si no se ha solicitado será 0.

            $this->datos['valores']['precio']+=intval($this->datos['valores']['llantas']);
            $this->datos['valores']['salida']+=intval($this->datos['valores']['llantas']);

            //Soy consciente que no es necesario pasarle los datos pero no se porque que si no lo hago no me funciona.
            $this->datos=$this->horaAleatoria($this->datos);

            $this->datos['valores']['coche']=$this->datos['valores']['marca'].' '.$this->datos['valores']['modelo'];

            $consulta = $this->conexion->prepare('INSERT INTO citas (id, entrada, salida, nombre, telefono, coche, matricula, tipo_lavado, llantas, precio) VALUES (:id, :entrada, :salida, :nombre, :telefono, :coche, :matricula, :tipoLavado, :llantas, :precio)');

            $consulta->bindParam(':id', $this-> datos['valores']['id']);
            $consulta->bindParam(':entrada', $this-> datos['valores']['entrada']);
            $consulta->bindParam(':salida', $this-> datos['valores']['salida']);
            $consulta->bindParam(':nombre', $this-> datos['valores']['nombre']);
            $consulta->bindParam(':telefono', $this-> datos['valores']['telefono']);
            $consulta->bindParam(':coche', $this-> datos['valores']['coche']);
            $consulta->bindParam(':matricula', $this-> datos['valores']['matricula']);
            $consulta->bindParam(':tipoLavado', $this-> datos['valores']['tipoLavado']);
            $consulta->bindParam(':llantas', $this-> datos['valores']['llantas']);
            $consulta->bindParam(':precio', $this-> datos['valores']['precio']);

            $consulta->execute();
            $this->datos['consulta'] = 'OK';
            $consulta->closeCursor();
            $consulta = null;
        }
    }

    public function listado(){
        $consulta = $this->conexion->prepare("SELECT * FROM citas");
        $consulta->execute();
        $listado = $consulta->fetchAll();
        $consulta->closeCursor();
        $consulta = null;
        return $listado;
    }

    public function buscarCita($id){

        $consulta = $this->conexion->prepare("SELECT * FROM citas WHERE id=$id");
        $consulta->execute();
        $citaCreada = $consulta->fetchAll();
        $consulta->closeCursor();
        $consulta = null;
        return $citaCreada;
    }

    private function validar(){
        $this->datos['valido'] = true;
        $this->datos['errores'] = array();

        if(!$this->datos['valores']['primeraVez']){
            
            /**
             * Nombre
             */

            if(!preg_match('/^[a-zA-Z]+$/',$this->datos['valores']['nombre'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['nombre'] = 'El nombre no cumple el formato.';
            }
            if(empty($this->datos['valores']['nombre'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['nombre'] = 'El campo no puede estar vacío.';
            }

            /**
             * Teléfono
             */

            if(!preg_match('/^[679][0-9]{8}$/',$this->datos['valores']['telefono'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['telefono'] = 'El teléfono no cumple el formato.';
            }
            if(empty($this->datos['valores']['telefono'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['telefono'] = 'El campo no puede estar vacío.';
            }

            /**
             * Matrícula
             */

            if(!preg_match('/^[0-9]{4}[a-zA-Z]{3}$/',$this->datos['valores']['matricula'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['matricula'] = 'La matrícula no cumple el formato.';
            }
            if(empty($this->datos['valores']['matricula'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['matricula'] = 'El campo no puede estar vacío.';
            }

            /**
             * Fecha
             */

            $fecha = DateTime::createFromFormat('d/m/Y', $this->datos['valores']['fecha']);
            $hoy = new DateTime();

            if($fecha===false){

                $this->datos['valido'] = false;
                $this->datos['errores']['fecha'] = 'La fecha no cumple el formato.';

            }else if($fecha<$hoy){

                $this->datos['valido'] = false;
                $this->datos['errores']['fecha'] = 'La fecha no puede ser anterior a hoy.';                

            }

            /**
             * Marca
             */

            if(empty($this->datos['valores']['marca'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['marca'] = 'El campo no puede estar vacío.';
            }

             /**
              * Modelo
              */

              if(empty($this->datos['valores']['modelo'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['modelo'] = 'El campo no puede estar vacío.';
            }

              /**
               * Tipo de lavado
               */

              if(empty($this->datos['valores']['tipoLavado'])){
                $this->datos['valido'] = false;
                $this->datos['errores']['tipoLavado'] = 'El campo no puede estar vacío.';
            }
        }else{
            $this->datos['valido'] = false;
        }
    }

    public function mostrarValores($nombre){

        echo (isset($this->datos['valores'][$nombre]) && !empty($this->datos['valores'][$nombre]) ?  $this->datos['valores'][$nombre] : "" );
    }

    function mostrarErrores($nombre){

        echo '<span>'.((isset($this->datos['errores'][$nombre]) && !empty($this->datos['errores'][$nombre])) ? $this->datos['errores'][$nombre] : "").'</span>';
    }

    function horaAleatoria($arrayDatos){
        
        $fechaNormal= DateTime::createFromFormat('d/m/Y', $arrayDatos['valores']['fecha']);
        $fechaServidor= $fechaNormal->format('Y/m/d');
    
        $hora_inicio = strtotime('8:00 AM');
        $hora_fin = strtotime('5:00 PM');
        $minutos_inicio = $hora_inicio / 60;
        $minutos_fin = $hora_fin / 60;
    
        /**
        * Sacamos un número aleatorio entre los minutos de hora de inicio y de fin.
        */
    
        $minutos_aleatorios = rand($minutos_inicio, $minutos_fin);
    
    
        /**
        * Obtenemos los múltiplos de 30 de los minutos aleatorios sacados por la función
        * rand, una vez pasados se redondean y se multiplica por 30 para revertir los numero 
        * a los minutos ya redondeados.
        */
        $minutos_redondeados = round($minutos_aleatorios / 30) * 30;
        
        /**
         * Sumamos los minutos redondeados a la variable de la hora de salida.
         */
        
        $arrayDatos['valores']['salida'] += $minutos_redondeados;
    
        /**
        * Convertir los minutos redondeados y los de salida a una hora legible añadiendo
        * la fecha formateada para que la BD la registre.
        * 
        * Básicamente lo que hacen las 2 siguientes lineas es coger la fecha del servidor 
        * que es la formateada para él y junto a los minutos formateado a 24 horas lo juntamos
        * en una cadena y lo parseamos a una única fecha, para finalmente darle el formato 
        * que especifica la tarea.
        */
        
        $arrayDatos['valores']['entrada'] = date('Y-m-d H:i', strtotime($fechaServidor.' '.date('H:i', $minutos_redondeados * 60)));
        $arrayDatos['valores']['salida'] = date('Y-m-d H:i', strtotime($fechaServidor.' '.date('H:i', $arrayDatos['valores']['salida'] * 60)));
    
        return $arrayDatos;
    }
}  