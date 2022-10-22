<?php include ("../templates/cabecera.php");?>
<?php include ("../secciones/cursos.php");?>

<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-5">
        <form action="" method="post">
          <div class="card">
            <div class="card-header">
              Gestión de temas
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label for="" class="form-label">Id</label>
                <!-- Imprime el valor $id almacenado mediante el value-->
                <input type="text"
                 class="form-control"
                 name="id" id="id"
                 aria-describedby="helpId"
                 placeholder="Id"
                 value="<?php echo $id;?>">
              </div>
              <div class="mb-3">
                <label for="nombre_curso" class="form-label">Tema de la reunión</label>
                <!-- Imprime el valor $nombre_curso almacenado mediante el value-->
                <input type="text"
                 class="form-control"
                 name="nombre_curso"
                 id="nombre_curso"
                 aria-describedby="helpId"
                 placeholder=""
                 value="<?php echo $nombre_curso;?>">
              </div>
              <div class="btn-group" role="group" aria-label="Button group name">
                <button type="submit" name="accion" value ="agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value ="editar" class="btn btn-warning">Editar</button>
                <button type="submit" name="accion" value ="borrar" class="btn btn-danger">Eliminar</button>
                <!-- Mediante el value recolectamos la info que se envia y se recepciona por el metodo post -->
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-7">
        <div class="table-responsive">
          <table class="table table-primary">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Mediante el foreach se leen los registros de la base de datos y se muestran-->
              <?php foreach($listaCursos as $curso){?>
              <tr class="">
                <td><?php echo $curso['id']; ?></td>
                <td><?php echo $curso['nombre_curso']; ?></td>
                <td> 
                  <!-- El form permite enviar info a través del click en cada botón -->
                <form action="" method="post">
                  <!--  trae el id oculto del registro -->
                  <input type="hidden" name="id" id="id" value="<?php echo $curso['id']; ?>">
                  <!-- Agrega el botón seleccionar y envia el valor -->
                  <input type="submit" value="seleccionar" name="accion" class="btn btn-info">
                </form>
                </td>
              </tr>
              <?php }?>
              <!-- Se termina el foreach -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php include ("../templates/pie.php");?>