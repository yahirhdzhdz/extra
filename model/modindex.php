<?php
include_once 'conexion.php';
$objeto=new Conexion();
$conexion=$objeto->Abrir_conexion();
$_POST=json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$paterno=(isset($_POST['paterno'])) ? $_POST['paterno'] : '';
$materno=(isset($_POST['materno'])) ? $_POST['materno'] : '';
$rool=(isset($_POST['rool'])) ? $_POST['rool'] : '';
$email=(isset($_POST['email'])) ? $_POST['email'] : '';
$password=(isset($_POST['password'])) ? $_POST['password'] : '';

$comentario=(isset($_POST['comentario'])) ? $_POST['comentario'] : '';
$idimagen=(isset($_POST['idimagen'])) ? $_POST['idimagen'] : '';
$idusuario=(isset($_POST['idusuario'])) ? $_POST['idusuario'] : '';
switch($opcion){
    case 1:
        $consulta="SELECT intId_Rool,vchRool FROM tblrool;";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta="SELECT tblusuarios.`intId_Usuario`,tblusuarios.`vchNombre`,tblusuarios.`vchApPaterno`,tblusuarios.`vchApMaterno`,tblusuarios.`vchEmail`,tblusuarios.`vchPassword`,tblrool.`vchRool` FROM tblusuarios,tblrool WHERE tblusuarios.`vchEmail`='$email' AND tblusuarios.`vchPassword`='$password' AND tblrool.`vchRool`='$rool' AND tblusuarios.`intId_Rool`=tblrool.`intId_Rool`;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        if($resultado->rowCount()){
            session_start();
            $contenido=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($contenido as $datos){
                $_SESSION['Clave']=$datos['intId_Usuario'];
                $_SESSION['Nombre']=$datos['vchNombre'];
                $_SESSION['Paterno']=$datos['vchApPaterno'];
                $_SESSION['Materno']=$datos['vchApMaterno'];
                $_SESSION['Email']=$datos['vchEmail'];
                $_SESSION['Password']=$datos['vchPassword'];
                $_SESSION['Rool']=$datos['vchRool'];
            }
            $_SESSION['Acceso']='AccessoConcedido'.$_SESSION['Rool'];
            $data='AccessoConcedido'.$_SESSION['Rool'];
        }
        break;  
    case 3:
        $consulta="INSERT INTO tblusuarios(vchNombre,vchApPaterno,vchApMaterno,vchEmail,vchPassword,intId_Rool)VALUES('$nombre','$paterno','$materno','$email','$password',1);";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        break;
    case 4:
        $consulta="INSERT INTO tblcomentarios(vchComentario,intId_Usuario,intId_Imagen)VALUES('$comentario','$idusuario','$idimagen');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        break;
    case 5:
        $consulta="SELECT tblimagenes.`intId_Imagen`,tblimagenes.`vchImagen`,tblusuarios.`vchNombre` ,tblcomentarios.`vchComentario` FROM tblimagenes,tblcomentarios,tblusuarios WHERE tblimagenes.`intId_Imagen`=tblcomentarios.`intId_Imagen` AND tblcomentarios.`intId_Usuario`=tblusuarios.`intId_Usuario`;";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>