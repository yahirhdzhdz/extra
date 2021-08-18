<?php
include 'cabecera.php';
?>
            <!-- DATO FECHA EN TIEMPO REAL -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header">
                            <h1>Bienvenido a nuestra tienda en línea, Encuentra todo lo que buscas y más.</h1>

                            <p class="pull-right text-primary">
                                <strong>
                                    
                                </strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DEL DATO FECHA -->
            <div id="img-linux-tux" class="container hidden-lg hidden-md hidden-sm">
                <center><img src="../src/img/multimedia/slide-header.png" class="img-responsive img-rounded" alt="Image"></center>
            </div>

            <div class="container hidden-xs">
                <div class="col-xs-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="5"></li>
                        </ol>
                        <div class="carousel-inner">
                        <div class="item active">
                            <img src="../src/img/multimedia/slider1.jpg" alt="">
                            <div class="carousel-caption">
                                Comparte tus Opiniones
                            </div>
                        </div>
                        <div class="item">
                            <img src="../src/img/multimedia/slider2.jpg" alt="">
                            <div class="carousel-caption">
                                Crea una Cuenta para Acceder a mas beneficios
                            </div>
                        </div>
                        <div class="item ">
                            <img src="../src/img/multimedia/slider3.jpg" alt="">
                            <div class="carousel-caption">
                                Danos yu opinion
                            </div>
                        </div>
                        <div class="item ">
                            <img src="../src/img/multimedia/slider4.jpg" alt="">
                            <div class="carousel-caption">
                                Ayudanos a mejorar
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="icon-next"></span>
                    </a>
                </div>
            </div>
                <div class="col-sm-2">&nbsp;</div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header">
                            <h1>Realiza tus compras rapido y sensillo </h1>
                            
                            <p class="pull-right text-primary">
                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>            
<!-- VISTA DE LAS IMAGENES -->
            
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#Todos" data-toggle="tab"><i class="fa fa-bars"></i>&nbsp;&nbsp;Nueva linea de ropa en almacen</a></li>
                        </ul>
                        <div class="tab-content">
                            <br>
                            <div class="tab-pane active" id="Todos">
                                <?php
                                foreach($contenido as $dato){
                                    $clave=$dato['intId_Imagen'];
                                    $imagen=$dato['vchImagen'];             
                                ?>
                                    <div class="col-sm-4">
                                        <div class="thumbnail text-center">
                                            <image src="../src/img/<?php echo $imagen;?>" ></image>
                                            <div class="caption">
                                            <?php if(isset($_SESSION['Rool']) && isset($_SESSION['Nombre'])): ?>
                                                <a href="imgdetalle.php?clave=<?=$dato['intId_Imagen']?>" class="btn btn-info btn-sm">Ver detalles</a></button>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--fin row paginacion-->
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <ul class="pagination">
                            <li class="disabled"><a href="#">«</a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
                                            </div>
                                              </div>
<?php
include 'pie.php';
?>