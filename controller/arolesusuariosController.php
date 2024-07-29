<?php
    require_once "model/rolUsuario.php";

    if(isset($_POST['editar'])){
        $id_usuario = htmlspecialchars($_POST['id_usuario']);
        $id_rol = htmlspecialchars($_POST['id_rol']);

        # objeto de la clase
        $rol = new rolUsuario();
        $roles = $rol->set_rol_usuario($id_usuario, $id_rol);
        require_once "view/dbTables/rolesUsuarios/rolesUsuarios.phtml";
    }else{
        require_once "view/error.phtml";
    }