<?php
if(!empty($_POST['btneditar'])) {
    $id=$_POST["id"];
    $nombre=$_POST["nombre"];
    $valor=$_POST["valor"];
    $descripcion=$_POST["descripcion"];
    $stock=$_POST["stock"];
    $categoria_id=$_POST["categoria_id"];

    $imagen=$_FILES["imagen"]["tmp_name"];
    $nombreimagen=$_FILES["imagen"]["name"];
    $tipoimagen=strtolower(pathinfo($nombreimagen, PATHINFO_EXTENSION));
    $directorio="archivos/";

    if (is file($imagen)){
        if($tipoimagen=="jpg" or $tipoimagen=="jpeg" or $tipoimagen=="png"){
            try {
                unlink($nombre);
            } catch (\Throwable $th) {

            }

            $ruta = $directorio . $id . "." . $tipoimagen;
            if(move_uploaded_file($imagen, $ruta)){
                $editar=$conexion->query("update img set foto='$ruta' where id_img=$id");

                if ($editar==1) {
                    echo "<div class='alert alert-success'>Correcto la imagen se ha subido con exito</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error al subir la imagen al servidor</div>";
                }
            } else {
                "<div class='alert alert-info'>Erro al subir la imagen al servidor</div>";
            }
                
            

        } else {
            echo "<div class='alert alert-info'>Solo se aceptan formatos jpg/jpeg/png</div>";
        }
    } else {
        echo "<div class='alert alert-info'>Debes seleccionar una imagen</div>";
    }





?>

<script>
    history.replaceState(null, null, location.pathname)
</script>

<?php }