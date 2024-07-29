<?php
    require_once "model/usuariosModel.php";
    require "passwordencriptadaController.php";

    if(isset($_POST["editar"])){
        $id = htmlspecialchars($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellidos']);
        $correo = htmlspecialchars($_POST['email']);
        $clave = $desencriptar(htmlspecialchars($_POST['clave']));
        $edad = htmlspecialchars($_POST['edad']);
        $celular = htmlspecialchars($_POST['celular']);
        $id_caracterizacion = htmlspecialchars($_POST['id_carac']);
        $estado = htmlspecialchars($_POST['estado']);

        # nueva instancia de la clase y de la funcion
        $pro = new Usuarios();
        $datos = $pro->set_usuarios($id, $nombre, $apellidos, $correo, $clave, $edad, $celular, $id_caracterizacion, $estado);
        require_once "view/dbTables/usuarios/usuarios.phtml";
    }else{
        require_once "view/error.phtml";
    }

?>