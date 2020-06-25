<!DOCTYPE html>
<html>
  <head>
    <title>Crear BD y cargar</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
  </head>
<body>
<!--BARRA SUPERIOR DE MENU-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="limpiar.php">Limpiar Registros <span class="sr-only">(current)</span></a>
          </li>
        </ul>
    <form class="form-inline my-2 my-lg-0"action="cerrar-sesion.php" method="post">
            <button  type="submit" class="btn btn-warning btn-outline-warning my-2 my-sm-0">Salir</button> 
    </form>
  </div>
</nav>
    <!--FIN BARRA SUPERIOR DE MENU-->
    
<!--BOTONES Y AREA DONDE SE DESPLIEGA LA INFO O NO-->
<!--<div class="container-fluid p-5 my-0 bg-dark text-white">-->   
    
    
    <div class="container-fluid p-4 my-3 text-black">        
        <div class="d-flex" id="wrapper"></div>
        <div class="row">
            <div class="col">
            <form action="cargamadre.php" method="post" enctype="multipart/form-data" id="import_form">
                <div><input type="text" class="form-control" "form-control-lg" name="nombrebdmadre" id="input1" placeholder="nombre de base madre" required> 
                </div>
                <div class="col-md-3">
                    <input type="file" name="file" />        
                </div>
                <div class="col-md-3">
                    <input type="submit" class="btn btn-dark btn-sm" name="import_data" value="Cargar Base Madre">
                </div>
            </form>
            </div>
            <div class="col">
                 <textarea class="form-control" id="textoresultadocarga" rows="3" readonly></textarea>
            </div>
        </div>
    </div>
    
    
    
<!--BOTONES Y AREA DONDE SE DESPLIEGA LA INFO O NO-->
    
    
<!--COLUMNAS DE LA BASE A DESPLEGAR-->    
    
    
    <!--
    <nav class="navbar navbar-expand-md bg-info navbar-info fixed-bottom">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="limpiar.php">Limpiar Registros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="generar.php">Generar base de contacto</a>
        </li>
      </ul>
    </nav> -->
</body>
</html>