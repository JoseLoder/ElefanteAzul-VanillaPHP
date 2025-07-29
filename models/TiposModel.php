<?php



class TiposModel extends Bd{
    private $conexion;
    private $tablaTipos = array();

    public function __construct()
    {

        $this->setTablaTipos();
    }

    private function setTablaTipos(){
        try{

            $this->conexion = new PDO('mysql:host=localhost;dbname='.$this->bbdd, $this->username, $this->password);
            $consulta = $this->conexion->prepare('SELECT * FROM tipo_lavado');
            $consulta->execute();

            $this->tablaTipos = $consulta->fetchAll();

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    
    function getTipos(){
        return $this->tablaTipos;
    }
    function mostrarTipos($tipoActual){
    
        echo '<select name="tipoLavado">';
        echo '<option value="">Elige un tipo de lavado..</option>';
    
        if(!empty($this->tablaTipos)){
            foreach($this->tablaTipos as $tipo){
                if($tipo['id'] == $tipoActual && !empty($tipoActual)){
                    echo '<option value="'.$tipo['id'].'" selected="selected">'.$tipo['descripcion'].'</option>';
                }
                else{
                    echo '<option value="'.$tipo['id'].'" >'.$tipo['descripcion'].'</option>';
                }
            }
        }
    
        echo '</select>';
    }

    public function getTipo($tipoActual){
        
        foreach ($this->tablaTipos as $tipo) {

            if($tipo['id']==$tipoActual){

            return $tipo['descripcion'];
            
            }
        }

    }
    
    public function buscarPrecio($tipoActual){
        foreach ($this->tablaTipos as $tipo) {

            if($tipo['id']==$tipoActual){

            return intval($tipo['precio']);
            
            }
        }
    }
}