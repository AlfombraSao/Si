<?php
if (!empty($_POST["emailadmin"]) && !empty($_POST["claveadmin"])) {
   $claveadmin = $_POST["claveadmin"];
   $email = $_POST["emailadmin"];

 include 'conexion_sql.php';

 $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE emailadmin='$emailadmin' and claveadmin='$claveadmin'");

 if(mysqli_num_rows($validar_login) > 0){
    header("Location: index.php");
    exit;
 }else{
    echo '
    <script>
    alert("Usuario no existe");
    window.location = "../INICIAR.php";
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