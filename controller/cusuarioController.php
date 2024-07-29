<?php
    require_once "model/usuariosModel.php";
    require_once "passwordencriptadaController.php";

    if(isset($_POST["crear"])){
        $id = htmlspecialchars($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellidos']);
        $correo = htmlspecialchars($_POST['email']);
        $clave = $encriptar(htmlspecialchars($_POST['clave']));

        $pro = new Usuarios();
        $datos = $pro->create_usuarios($id, $nombre, $apellidos, $correo, $clave);
        require_once "view/dbTables/usuarios/usuarios.phtml";
    }else{
        require_once "view/error.phtml";
    }