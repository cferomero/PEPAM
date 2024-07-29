<?php
    spl_autoload_register("mi_autocargador");
    require_once "model/logModel.php";
    require_once("passwordencriptadaController.php");

    if(isset($_POST['p3pam'])){
        $id_usuario = htmlspecialchars($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellido']);
        $correo = htmlspecialchars($_POST['email']);
        $password = $encriptar(htmlspecialchars($_POST['password']));

        $pro = new Log();
        $datos = $pro->create_usuarios($id_usuario, $nombre, $apellidos, $correo, $password);
        if($datos){
            header('Location: ../index.php?mensaje=Exito');
        }else{
            header('Location: ../index.php?mensaje=Error');
        }
        exit();
    }else{
        require_once ("view/error.phtml");
    }
?>
