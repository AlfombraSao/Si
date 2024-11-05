<?php
if (!empty($_POST["emailusuario"]) && !empty($_POST["claveusuario"])) {
   $claveusuario = $_POST["claveusuario"];
   $email = $_POST["emailusuario"];

 include 'conexion_sql.php';

 $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE emailusuario='$emailusuario' and claveusuario='$claveusuario'");

 if(mysqli_num_rows($validar_login) > 0){
    header("Location: index.php");
    exit;
 }else{
    echo '
    <script>
    alert("Usuario no existe");
    window.location = "../IniciarSesion.php";
    </script>
    ';
    exit;
 }

 if($resultado == False) {$Mensaje="No se pudo iniciar el usuario por error en los datos, inténtelo de nuevo"; }
                         
 else{
    echo '
      <script>
          alert("Sesion Iniciada");
         window.location = "../index.php";
      </script>
    ';
 }
}


?>