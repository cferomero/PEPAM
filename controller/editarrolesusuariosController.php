<?php
    require_once "model/rolUsuario.php";
    $rol = new rolUsuario();
    $roles = $rol->get_rol_usuario_id();
    require_once "view/dbTables/rolesUsuarios/editarRolesUsuarios.phtml";