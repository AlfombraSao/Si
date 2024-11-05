<?php

session_start();

include("conexion_sql.php");
if(mysqli_connect_error()){
    exit("Fallo al conectarse a la base de datos ".mysqli_connect_error());
}

if(!isset($_POST["NombreUsuario"], $_POST["ClaveUsuario"])){
    header("Location: index.php");
    }

if($Resultado = $conexion->prepare('select CodigoUsuario, NombreUsuario, ClaveUsuario, TipoUsuario from usuario where NombreUsuario = ?')){
    $Resultado->bind_param('s', $_POST["NombreUsuario"]);
    $Resultado->execute();
    }

    $Resultado->store_result();
    if($Resultado->num_rows > 0 ) {
        $Resultado->bind_result($CodigoUsuario, $NombreUsuario, $ClaveUsuario, $TipoUsuario);
        $Resultado->fetch();   
        if($_POST["ClaveUsuario"]==$ClaveUsuario){
            //Iniciar sesion
            $_SESSION['loggedin'] = True;
            $_SESSION['NombreUsuario'] = $_POST["NombreUsuario"];
            $_SESSION['TipoUsuario'] = $TipoUsuario;
            $_SESSION['CodigoUsuario']= $CodigoUsuario;
            echo "es:".$_SESSION['loggedin']." es ".$_SESSION['NombreUsuario']." es ".$_SESSION['TipoUsuario'].$_POST["ClaveUsuario"];
            if(isset($_SESSION["CodigoProyecto"])){header("Location: ../vista/Carrito.php");}
            else{header("Location: ../index.php");}
            }
            else {header("Location: ../index.php");
            } 

        }

    else {
        //header("Location: ../index.php");
    } 

    $Resultado->close();

?>    