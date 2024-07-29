<?php
    require_once 'model/rolUsuario.php';
    $rolUser = new rolUsuario();
    $roles = $rolUser->get_rol_usuario();
    require_once 'view/dbTables/rolesUsuarios/rolesUsuarios.phtml';