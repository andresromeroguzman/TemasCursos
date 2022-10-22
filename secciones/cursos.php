
<?php
include_once '../configuraciones/bd.php';
$conexionBD= BD::crearInstancia();

// Si detectamos que el campo id tiene información, entonces la asignamos, de lo contrario le ponemos nulo si no tiene nada.
$id=isset($_POST['id'])?$_POST['id']:'';
// Si detectamos que el campo nombre_curso tiene información, entonces la asignamos, de lo contrario le ponemos nulo si no tiene nada.
$nombre_curso=isset($_POST['nombre_curso'])?$_POST['nombre_curso']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';


// Mediante un Switch evaluamos si hay accion
if($accion){
    switch($accion){
        // Evaluamos las instrucciones para imprimir lo que se selecciona
        case 'agregar':
            // Arma la consulta y la ejecuta agregando los valores
            $sql="INSERT INTO cursos (id,nombre_curso) VALUES (NULL, :nombre_curso)";
            // prepara la consulta para poderla ejecutar
            $consulta =$conexionBD->prepare($sql);
            // Le pasa un parámetro
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            // La ejecuta
            $consulta->execute();            
            break;
        case 'editar':
            // Actualiza cursos  cambiando nombre_curso por el valor que viene con nombre_curso cuando el id sea igual a id
            $sql="UPDATE cursos SET nombre_curso=:nombre_curso where id=:id";
            $consulta=$conexionBD->prepare($sql);
            // Se reemplaza id
            $consulta->bindParam(':id',$id);
            // Se reemplaza nombre_curso
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->execute();            
            break;
        case 'borrar':
            // Cuando se presione borrar se trae el id seleccionado 
            $sql ="DELETE from cursos where id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam('id',$id);
            $consulta->execute();
             break;            
        case "seleccionar":
            // Seleccionamos el registro y se busca el id
            $sql="SELECT * from cursos where id=:id";
            $consulta=$conexionBD->prepare($sql);
            // Se pasa la info
            $consulta->bindParam(':id', $id);
            // Se ejecuta la info
            $consulta->execute();
            // Muestra los registros recuperados de la consulta inicial y se imprimen
            $curso=$consulta->fetch(PDO::FETCH_ASSOC);  
            //   Recupera la info para el form Se almacena la informacion en la variable $nombre_curso y la obtenga de la consulta seleccionar mostrando el valor nombre_curso
            $nombre_curso=$curso['nombre_curso'];
            // echo $nombre_curso;
            break;
    }
}

// Consulta toda la información de la tabla cursos.
$consulta = $conexionBD->prepare("SELECT * FROM cursos");
$consulta->execute();
// Muestra los datos que trae la consulta, fetchall retorna los datos y los muestra en una lista.
$listaCursos=$consulta->fetchAll();


?>

