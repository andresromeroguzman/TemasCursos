<?php
include_once '../configuraciones/bd.php';
$conexionBD= BD::crearInstancia();

// Validamos los datos del alumno
$id=isset($_POST['id'])?$_POST['id']:'';
$nombre=isset($_POST['nombre'])?$_POST['nombre']:'';
$apellidos=isset($_POST['apellidos'])?$_POST['apellidos']:'';
// Datos  de los cursos
$cursos=isset($_POST['cursos'])?$_POST['cursos']:'';
// Accion que se ejecuta
$accion=isset($_POST['accion'])?$_POST['accion']:'';


if($accion!=""){
    switch($accion){
        // Cuando presione agregar insertará los datos en la tabla alumnos
        case 'agregar':
            $sql="INSERT INTO alumnos (id,nombre,apellidos) VALUES (NULL,:nombre,:apellidos)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellidos',$apellidos);
            $consulta->execute();
            // Recupera el Id que se genera cuando se inserta cada registro
            $idAlumno=$conexionBD->lastInsertId();

            foreach($cursos as $curso){
                $sql ="INSERT INTO alumnos_cursos (id, idalumno, idcurso) VALUES (NULL,:idalumno,:idcurso)";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':idalumno',$idAlumno);
                $consulta->bindParam(':idcurso',$curso);
                $consulta->execute(); 
            }
        break;
        case 'Seleccionar':           
            $sql="SELECT * FROM alumnos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre=$alumno['nombre'];
            $apellidos=$alumno['apellidos'];

            $sql = "SELECT cursos.id FROM alumnos_cursos
            INNER JOIN cursos
            ON cursos.id=alumnos_cursos.idcurso
            where alumnos_cursos.idalumno=:idalumno";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':idalumno',$id);
            $consulta->execute();
            $cursosAlumno=$consulta->fetchAll(PDO::FETCH_ASSOC);

            foreach($cursosAlumno as $curso){           
                $arregloCursos[]=$curso['id'];
            }
           
        break;
        case 'borrar':
            $sql="DELETE FROM alumnos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
        break;
        case 'editar':
            $sql="UPDATE alumnos SET nombre=:nombre, apellidos=:apellidos WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre',$nombre);
            $consulta->bindParam(':apellidos',$apellidos);
            $consulta->bindParam(':id',$id);
            $consulta->execute();

            if(isset($cursos)){
                $sql="DELETE FROM alumnos_cursos WHERE idalumno=:idalumno";
                $consulta=$conexionBD->prepare($sql);
                $consulta->bindParam(':idalumno',$id);
                $consulta->execute();

                foreach($cursos as $curso){
                    $sql="INSERT INTO alumnos_cursos(id, idalumno, idcurso) 
                    VALUES (NULL,:idalumno,:idcurso)";
                    $consulta=$conexionBD->prepare($sql);
                    $consulta->bindParam(':idalumno',$id);
                    $consulta->bindParam('idcurso',$curso);
                    $consulta->execute();
                }
                $arregloCursos=$cursos;
            }
    }
}

// Traer los datos de la tabla alumnos
$sql = "SELECT * from alumnos";
$listaAlumnos=$conexionBD->query($sql);
$alumnos=$listaAlumnos->fetchAll();

foreach($alumnos as $clave => $alumno){
    // Se leen todos los alumnos
    $sql="SELECT * FROM cursos
    where id IN (SELECT idcurso FROM alumnos_cursos WHERE idalumno=:idalumno)";
    $consulta=$conexionBD->prepare($sql);
    $consulta->bindParam(':idalumno',$alumno['id']);
    $consulta->execute();
    // Se Obtienen todos los registros relacionados al id del alumno
    $cursosAlumno=$consulta->fetchAll();
    $alumnos[$clave]['cursos']=$cursosAlumno;
}
$sql = "SELECT * FROM cursos";
$listaCursos=$conexionBD->query($sql);
$cursos=$listaCursos->fetchAll();
?>