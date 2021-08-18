<?php
session_start();
header('Content-Type: text/html; charset=UTF-8'); 
require_once('../model/conexion.php');
$clave=$_GET['clave'];
if(isset($_GET['clave'])){
    $objeto=new Conexion();
    $conexion=$objeto->Abrir_conexion();
    
	
    $consultaB="SELECT vchImagen FROM tblimagenes WHERE intId_Imagen='$clave';";
    $resultadoB=$conexion->prepare($consultaB);
    $resultadoB->execute();
    if($resultadoB->rowCount()){
        $contenidoB=$resultadoB->fetchAll(PDO::FETCH_ASSOC);
        foreach($contenidoB as $datoB){
            $imagen=$datoB['vchImagen'];
        }
    }
}else{
    header("location:imagenes.php");
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina principal</title>
        <link rel="shortcut icon" type="image/x-icon" href="../src/img/multimedia/logo.png">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../src/css/bootstrap.css"> 
        <link rel="stylesheet" href="../src/css/style.css">  
        <link rel="stylesheet" href="../src/css/animate.css">
        <link rel="stylesheet" href="../src/css/MediaQueries.css">
        <link rel="stylesheet" href="../src/css/font-awesome.min.css">
        <link rel="stylesheet" rel="stylesheet" href="../src/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">      
        <script src="../src/js/jquery-2.1.0.min.js"></script>
        <script src="../src/js/bootstrap.js"></script>
        <script src="../src/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="../src/js/validaciones.js"></script>
        <link rel="stylesheet" href="../src/css/sweetalert2.min.css">  
        <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="4fc16086-1601-41e8-87af-33695083236a";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>   
    </head>
    <body>  
        <div id="index"> 

            <!-- MENU WEB  -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button>
                        <a class="navbar-brand" href="index.php"><img src="../src/img/multimedia/logo.png" width="50px" height="50px"></i>&nbsp;&nbsp;Turing Intelligence</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <?php if(isset($_SESSION['Rool']) && isset($_SESSION['Nombre'])): ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <?php if($_SESSION['Rool']=="Cliente"): ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-user"></span> &nbsp; <?php echo $_SESSION['Nombre']; ?><b class="caret"></b>
                                </a>
                                <?php endif; ?>
                                <ul class="dropdown-menu">                                    
                                    <li>
                                        <a href=""><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Mensajes</a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                                    </li> 
                                    <li class="divider"></li>
                                    <li ><a href="cerrarsesion.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php endif; ?>
                        <form class="navbar-form navbar-right hidden-xs" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Buscar">
                            </div>
                            <button type="button" class="btn btn-success">Buscar</button>
                        </form>
                        <ul class=" nav navbar-nav navbar-right">
                            <li>
                                <a href="index.php"><span ></span> &nbsp; Inicio</a>
                            </li>
                            <li>
                                <a href="mapa.php"><span ></span> &nbsp;Mapa del sitio</a>
                            </li>
                            <li>
                                <a href="ayuda.php"><span ></span> &nbsp;Ayuda</a>
                            </li>
                            
                            <?php if(!isset($_SESSION['Rool']) && !isset($_SESSION['Nombre'])): ?>
                            <li>
                                <a href="registrar.php"><i class="fa fa-users"></i>&nbsp;&nbsp;Registrarse</a>
                            </li>
                            <li>
                                <a href="#!" data-toggle="modal" data-target="#modalLog"><span ></span>&nbsp;&nbsp;Login</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        
                    </div>
                </div>
            </nav>
        
            <!-- MODAL DE LOGIN -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalLog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title text-center text-primary" id="myModalLabel">Acceso restringido</h4>
                        </div>
                        <form style="margin: 20px;">
                            <div class="text-center">
                                <a href="#">
                                    <img src="../src/img/multimedia/usuario.png" width="100px" height="100px" alt="CoolAdmin">
                                </a>
                            </div>
                            <br>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-users"></span>
                                    </div>
                                    <select id="cmbRool" class="form-control">
                                        <option v-bind:value="0">Tipo de usuario</option>
                                        <option v-for="(TPUsuario,indice) of ctTPUsuario" v-bind:value="TPUsuario.vchRool">
                                            {{TPUsuario.vchRool}}
                                        </option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-envelope"></span>
                                    </div>
                                    <input id="Email" type="text" class="form-control" name="nombre_login" placeholder="Ejemplo@hotmail.com" required="" maxlength="50" onpaste="return false"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-lock"></span>
                                    </div>
                                    <input id="Password" type="password" class="form-control" name="contrasena_login" placeholder="Escribe tu contraseña" required="" maxlength="12" onkeypress="return CEspeciales(event)" onpaste="return false"/>
                                </div>                                
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" @click="iniciarsesion">Iniciar sesión</button>
                                </diV>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- DATO FECHA EN TIEMPO REAL -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header">
                            <h1>Detalles del Producto </h1>
                            
                            <p class="pull-right text-primary">
                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DEL DATO FECHA -->
            <!-- VISTA DE LAS IMAGENES -->
            <div class="container">
                <div class="abs-center">
                    <div class="content-wrapper">
                        <section class="content">
                            <div class="card card-solid">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="col-12">
                                                <image src="../src/img/<?php echo $imagen;?>" height="400px" width="300px"></image>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 product-summery">
                                            <div class="col-sm-6">
                                            <div class="thumbnail text-center">

                                                <div class="caption">
                                                    <div class="product-category text-muted">
                                                    
                                                    <input id="txtidusuario" type="text" class="form-control" placeholder="Escribe tu comentario" value="<?php echo $_SESSION['Clave'];?>" style="visibility:hidden">
                                                        <?php
                                                            $consultaA="SELECT intId_Imagen, vchTitulo, vchdescripcion, fltprecio, fltdescuento FROM tblimagenes WHERE intId_Imagen='$clave';";
                                                            $resultadoA=$conexion->prepare($consultaA);
                                                            $resultadoA->execute();
                                                            if($resultadoA->rowCount()){
                                                                $contenidoA=$resultadoA->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach($contenidoA as $datoA){
                                                                    
                                                                    $titulo=$datoA['vchTitulo'];
                                                                    $descripcion=$datoA['vchdescripcion'];
                                                                    $precio=$datoA['fltprecio'];
                                                                    $descuento=$datoA['fltdescuento'];
                                                                    echo "<br>";
                                                                    echo "<h4>Nombre:".$titulo."</h4>";
                                                                    echo "<br>";
                                                                    echo "Descripcion: ".$descripcion;
                                                                    echo "<br>";
                                                                    echo "<br>";
                                                                    echo "Precio:".$precio."$";
                                                                    echo "<br>";
                                                                    echo "Descuento de : ".$descuento."%";
                                                                }
                                                            }
                                                        ?>  
                                                    <input id="txtidimagen" type="text" class="form-control" value="<?php echo $clave;?>" style="visibility:hidden">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-xs-12 col-md-6 product-summery">
                                            <div >
                                            <div class="thumbnail text-center">
                                                <div class="caption">
                                                    <div class="product-category text-muted">
                                                    <h2>Comentarios de los clientes</h2>
                                                    <input id="txtidusuario" type="text" class="form-control" placeholder="Escribe tu comentario" value="<?php echo $_SESSION['Clave'];?>" style="visibility:hidden">
                                                        <?php
                                                            $consultaA="SELECT tblusuarios.`vchNombre`,tblcomentarios.`vchComentario` FROM tblusuarios,tblcomentarios WHERE intId_Imagen='$clave' AND tblusuarios.`intId_Usuario`=tblcomentarios.`intId_Usuario`;SELECT tblusuarios.`vchNombre`,tblcomentarios.`vchComentario` FROM tblusuarios,tblcomentarios WHERE intId_Imagen='$clave' AND tblusuarios.`intId_Usuario`=tblcomentarios.`intId_Usuario`;";
                                                            $resultadoA=$conexion->prepare($consultaA);
                                                            $resultadoA->execute();
                                                            if($resultadoA->rowCount()){
                                                                $contenidoA=$resultadoA->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach($contenidoA as $datoA){
                                                                    $nombre=$datoA['vchNombre'];
                                                                    $comentario=$datoA['vchComentario'];
                                                                    echo "<br>";
                                                                    echo $nombre." dijo: ".$comentario;
                                                                    echo "<br>";
                                                                }
                                                            }
                                                        ?>  
                                                    <input id="txtidimagen" type="text" class="form-control" value="<?php echo $clave;?>" style="visibility:hidden">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <div>
                                            <div class="thumbnail text-center">
                                                <div class="caption">
                                                    <?php if(isset($_SESSION['Rool']) && isset($_SESSION['Nombre'])): ?>
                                                        <input id="txtcomentario" type="text" class="form-control" placeholder="Escribe tu comentario" maxlength="1000" onkeypress="return soloLetras(event)" onpaste="return false">
                                                        <br>
                                                        <button type="button" class="btn btn-info"  @click="notas">Enviar comentario</button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <br>
            </div>
            <!-- FIN DE LA VISTA DE LOS PRODUCTOS -->
            <!-- INICIO DEL FOOTER -->
<?php
include 'pie.php';
?> 
