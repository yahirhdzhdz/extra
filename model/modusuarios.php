<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
$_POST= json_decode(file_get_contents("php://input"), true);
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$clave=(isset($_POST['clave'])) ? $_POST['clave'] : '';
$nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$paterno=(isset($_POST['paterno'])) ? $_POST['paterno'] : '';
$materno=(isset($_POST['materno'])) ? $_POST['materno'] : '';
$email=(isset($_POST['email'])) ? $_POST['email'] : '';
$password=(isset($_POST['password'])) ? $_POST['password'] : '';
$rool=(isset($_POST['rool'])) ? $_POST['rool'] : '';
switch($opcion){
    case 1:
        $consulta="SELECT intId_Rool,vchRool FROM tblrool;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case 2:
        $consulta="SELECT intId_Usuario,vchNombre,vchApPaterno,vchApMaterno,vchEmail,vchPassword,intId_Rool FROM tblusuarios;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;
    case 3:
        $consulta="INSERT INTO tblusuarios(vchNombre,vchApPaterno,vchApMaterno,vchEmail,vchPassword,intId_Rool)VALUES('$nombre','$paterno','$materno','$email','$password','$rool');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    case 4:
        $consulta="UPDATE tblusuarios SET vchNombre='$nombre',vchApPaterno='$paterno',vchApMaterno='$materno',vchEmail='$email',vchPassword='$password',intId_Rool='$rool' WHERE intId_Usuario='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();       
        break;       
    case 5:
        $consulta = "DELETE FROM tblusuarios WHERE intId_Usuario='$clave';";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break; 
}
print json_encode($data,JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>