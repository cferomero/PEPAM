<?php
    require_once "model/usuariosModel.php";

    $pro = new Usuarios();
    $datos = $pro->get_usuarios_id();
    require_once "view/dbTables/usuarios/editarUsuarios.phtml";