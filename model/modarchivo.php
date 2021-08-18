<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Abrir_conexion();
//$_POST = json_decode(file_get_contents("php://input"), true);
$opcion =(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$clave=(isset($_POST['clave'])) ? $_POST['clave'] : '';
$imagen=(isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name']: '';
$titulo=(isset($_POST['titulo'])) ? $_POST['titulo'] : '';
$descripcion=(isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$precio=(isset($_POST['precio'])) ? $_POST['precio'] : '';
$descuento=(isset($_POST['descuento'])) ? $_POST['descuento'] : '';
$borrar=(isset($_POST['borrar'])) ? $_POST['borrar'] : '';
switch($opcion){
    case 1:
        $consulta = "SELECT intId_Imagen,vchImagen, vchTitulo, vchdescripcion, fltprecio, fltdescuento FROM tblimagenes;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:
        $consulta="INSERT INTO tblimagenes(vchImagen, vchTitulo, vchdescripcion, fltprecio, fltdescuento)VALUES('$imagen','$titulo','$descripcion','$precio','$descuento');";
        $resultado = $conexion->prepare($consulta);
        $rtactual=$_FILES['imagen']['tmp_name']; 
        $resultado->execute();
        $ruta="../src/img/".$imagen;
        if($resultado) {
            move_uploaded_file($rtactual,$ruta);
        }   
        break;
    case 3:
        $consulta="UPDATE tblimagenes SET vchImagen='$imagen', vchTitulo='$titulo', vchdescripcion='$descripcion', fltprecio='$precio', fltdescuento='$descuento' WHERE intId_Imagen='$clave';";
        $rtactual=$_FILES['imagen']['tmp_name']; 
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $ruta="../src/img/".$imagen;
        if($resultado) {
            move_uploaded_file($rtactual,$ruta);
             unlink($borrar);
        }
        break;
    case 4:
        $consulta = "DELETE FROM tblimagenes WHERE intId_Imagen='$clave';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        if($resultado) 
        {
            unlink($borrar);
        }
        break;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>