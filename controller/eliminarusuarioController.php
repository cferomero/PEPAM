<?php
    require_once "model/usuariosModel.php";

    if(!empty($_GET["valor"])){
        $id = $_GET["valor"];
        $usuarios = new Usuarios();
        $datos = $usuarios->delete_usuarios($id);
        require_once "view/dbTables/usuarios/usuarios.phtml";
    }else{
        require_once "view/error.phtml";
    }