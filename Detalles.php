<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

print_r($_SESSION);

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset( $_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token == ''){
  echo 'Error al procesar la peticion';
  exit;
} else {

  $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

if($token == $token_tmp){

  $sql = $con->prepare("SELECT count(id) FROM productoS WHERE id=? AND activo=1");
$sql->execute([$id]);
if($sql->fetchColumn() > 0) {


  $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productoS WHERE id=? AND activo=1");
$sql->execute([$id]);
$row = $sql->fetch(PDO::FETCH_ASSOC);
$nombre = $row ['nombre'];
$precio = $row ['precio'];
$descripcion = $row ['descripcion'];
$descuento = $row ['descuento'];
$precio_desc = $precio - (($precio*$descuento)/100);
$dir_images = 'images/productos/'. $id .'/';

$rutaimg = $dir_images . 'r.jpg';

if(!file_exists($rutaimg)){
  $rutaimg = 'images/no-photo.jpg';
}

$imagenes = array();
if(file_exists($dir_images)){
$dir = dir($dir_images);

while(($archivo = $dir->read())!= false){
    if($archivo != 'r.jpg' && (strpos($archivo, 'jpg')|| strpos($archivo, 'jpg'))){
      $imagenes[] = $dir_images . $archivo;
    }
}
  $dir ->close();
}
}
} else {

  echo '';
  exit;

}

}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
     crossorigin="anonymous">
    <link href="productos.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css" media="screen">
<link rel="stylesheet" href="css/estilos.css">
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

<main>
  <div class="container">
    <div class="row">
      <div class= "col-md-6 order-md-1">

      <div id="carouselimages" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo $rutaimg ;?>" alt="image" height="500" width="500" class="d-block w-100">
    </div>
    <?php foreach($imagenes as $img) { ?>
    <div class="carousel-item">
    <img src="<?php echo $img ;?>" alt="image" height="500" width="500" class="d-block w-100">
    </div>
 <?php }?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselimages" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselimages" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

      </div>
        <div class= "col-md-6 order-md-2">
          <h2><?php echo $nombre;?></h2>

          <?php if($descuento >0) {?>
            <p><del><?php echo MONEDA . number_format($precio, 2, '.', ',');?></del></p>
            <h2>
              <?php echo MONEDA . number_format($precio_desc, 2, '.', ',');?>
            <small class="text-success"><?php echo $descuento; ?> % descuento</small>
            </h2>

            <?php } else { ?>


         <p><del><?php echo MONEDA . number_format($precio, 2, '.', ',');?></del></p>

         <?php } ?>
         
          <P class="lead">
            <?php echo $descripcion; ?>

          </P>

          <div class="d-grid gap-3 col-10 mx-auto">
            <button class="btn btn-primary" type="button">Comprar ahora</button>
            <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id;  ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>

            
          </div>

        </div>
    </div>
  </div>
</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous">
</script>
<script>
  function addProducto(id, token){
    let url = 'clases/carrito.php'
    let formData = new FormData()
    formData.append('id', $id)
    formData.append('token', $token)

    fetch(url,{
      method: 'POST',
      body: formData,
      mode: 'cors'
    }).then(response => response.json())
    .then(data => {
      if(data.ok){
        let elemento = document.getElementById("num_cart")
        elemto.innerHTML = data.numero
      }
    })
  }
</script>
 
</body>

</html>

