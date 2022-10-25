<?php
session_start();
if($_POST){
  $mensaje = 'Usuario o contraseña Incorrectos';
  if($_POST['usuario']=='admin' && $_POST['contrasena']=='admin'){

    $_SESSION['usuario']=$_POST['usuario'];
    echo "Login Correcto";
   header('Location:secciones/index.php');  
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Reunion Virtual</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">   
                <ul class="nav navbar-expand navbar-light bg-light justify-content-end">                     
                      <li class="nav-item">
                        <a class="nav-link href="cerrar.php">Cerrar sesion</a>
                      </li>
                    </ul>
      </div>
    </div>
    <div class="row">
        <div class="col-md-4"> 
        </div>
        <div class="col-md-4"> 
          <br>
          <form action="" method="post"> 
              <div class="card">
                <div class="card-header">
                 Inicio de Sesion
                </div>
                <div class="card-body">
                  <?php if(isset($mensaje)) {?>
                    <div class="alert alert-danger" role="alert">
                      <strong><?php echo $mensaje;?></strong> 
                    </div>  
                    <?php } ?>
                   <div class="mb-3">
                     <label for="" class="form-label">Usuario</label>
                     <input type="text"
                       class="form-control"
                        name="usuario" id="usuario"
                         aria-describedby="helpId" placeholder="">
                     <small id="helpId" class="form-text text-muted">Escriba su Usuario</small>
                   </div>
                   <div class="mb-3">
                     <label for="" class="form-label">Contraseña</label>
                     <input type="password"
                       class="form-control" name="contrasena" id="contrasena" aria-describedby="helpId" placeholder="">
                     <small id="password" class="form-text text-muted">Escriba su contraseña</small>
                   </div>
                   <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
                </div> 
                </form>              
            </div>
        </div>
    
        <div class="col-md-4"> 
        </div>
    </div>
  </div>
  
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
    integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
  </script>
</body>

</html>