<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id,nombre,precio FROM productoS WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords">
    <meta name="description" >
    <title>inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="productos.css" rel="stylesheet">
 <link rel="stylesheet" href="css/css.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="js.js" defer=""></script>  
  </head>
  
  <body class="u-body u-xl-mode"><header class="u-clearfix u-header u-sticky u-sticky-1a7a u-white u-header" id="sec-6138"  data-animation-duration="0" data-animation-delay="0" data-animation-direction=""><div class="u-clearfix u-sheet u-sheet-1">
        <a href="inicio.html" class="u-image u-logo u-image-1" data-image-width="1363" data-image-height="1363">
          <img src="images/logo.jpg" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="inicio.html" style="padding: 10px 20px;">inicio</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="inicio.html#carousel_740a" data-page-id="52815737" style="padding: 10px 20px;">productos</a>
<div class="u-nav-popup"><ul class="u-h-spacing-20 u-nav u-unstyled u-v-spacing-10">
    <li class="u-nav-item"><a class="u-button-style u-nav-link u-white" href="productos/cortinas.html">cortinas</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-white" href="productos/cortinas.html">tapetes</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-white" href="productos/peliculas.html">peliculas</a>
</li></ul>
</div>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="galeria.html" style="padding: 10px 20px;">galeria</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="inicio.html#carousel_3455" data-page-id="52815737" style="padding: 10px 20px;">Contacto</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="carrito.php" style="padding: 10px 20px;">Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span></a>
</li></ul>
          </div>
        </nav>
        <a class="u-login u-preserve-proportions u-login-1" href="#" title="Página 1">Iniciar sesión</a>
      </div><style class="u-sticky-style" data-style-id="1a7a">.u-sticky-fixed.u-sticky-1a7a:before, .u-body.u-sticky-fixed .u-sticky-1a7a:before {
borders: top right bottom left !important; border-color: #404040 !important; border-width: 2px !important
}</style>
</header>

<!--contenido del marco-->

<main>
  
  <div class="album py-5 bg-light" class="d-block w-100">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach ($resultado as $row){ ?>
        <div class="col" >
          <div class="card shadow-sm">
              <?php

              $id = $row['id'];
              $imagen = "images/productos/$id/R.jpg";
            

              if(!file_exists($imagen)){
                $imagen = "images/no-photo.jpg";
              }

              ?>
            <img src="<?php echo $imagen; ?> " class="d-block w-100" alt="image" height="400" width="400">
            <div class="card-body">
              <p class="card-title"><?php echo $row['nombre'] ?></p>
              <p class="card-text"><?php echo number_format( $row['precio'],2,'.',','); ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1',$row['id'], KEY_TOKEN); ?>" class="btn btn-primary">detalles</a>
                </div>
                <a href="" class="btn btn-success">Agregar</a>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
    </div>
  </div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"  crossorigin="anonymous">
</script>

 
</body>

</html>

