<?php
    require_once "model/usuariosModel.php";
    $user = new Usuarios();
    $datos = $user->get_usuarios();
    require_once "view/dbTables/usuarios/usuarios.phtml";