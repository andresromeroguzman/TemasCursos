<?php
    // Esta $instancia nos sirve para almacenar la conexión
    // Pregunta si hubo una conexión mediane el metodo crearInstancia, se valida y se realiza lo siguiente; parametros $opciones para activar propiedades para poder trabajar con la base de datos
    // self:: crea la instancia mediante la variable $instancia junto con los valores de base de datos, usuario y contraseña
class BD{
    public static $instancia=null;
    public static function crearInstancia(){
        if( !isset(self::$instancia)){
            $opciones[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instancia = new PDO('mysql:host=localhost;dbname=aplicacion','root','',$opciones);
            // echo "conectado";
        }
        return self::$instancia;
    }

}

?>

