<?php
include 'cabecera.php';
?>
            <div class="container">
            <div class="col-sm-12">
                        <div class="page-header">
                            <h1 >Registrate y se parte de nuestra comunidad, opina y mira sin restricciones</h1>
                        </div>
                    </div>
            </div>
            <!-- FIN DEL DATO FECHA -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="container">
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tab-content">
                                        <br>
                                        <div class="col-sm-12">
                                            <div class="panel panel-info">
                                                <div class="panel-heading text-center">&nbsp;<strong>Formulario de Registros</strong></div>
                                                    <div class="panel-body">
                                                        <form role="form">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-address-book-o"></i>
                                                                    </div>
                                                                    <input  id="txtNombre" type="text" class="form-control" placeholder="Nombre" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-address-book-o"></i>
                                                                    </div>
                                                                    <input id="txtPaterno" type="text" class="form-control" placeholder="Apellido paterno" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-address-book-o"></i>
                                                                    </div>
                                                                    <input id="txtMaterno" type="text" class="form-control" placeholder="Apellido materno" maxlength="40" onkeypress="return soloLetras(event)" onpaste="return false">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-envelope"></i>
                                                                    </div>
                                                                    <input id="txtEmail" type="text" class="form-control" placeholder="Email" maxlength="100" onpaste="return false">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="glyphicon glyphicon-lock"></i>
                                                                    </div>
                                                                    <input id="txtPassword" type="password" class="form-control" placeholder="Password" maxlength="10" onpaste="return false">
                                                                </div>
                                                            </div>
                                                            <center><button type="button" class="btn btn-info"  @click="insertardatos">Guardar datos</button></center>
                                                        </form>
                                                    </div>
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