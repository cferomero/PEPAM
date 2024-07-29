<?php
    require 'model/roles.php';
    $roles = new Roles();
    $rol = $roles->get_roles();
    require_once 'view/dbTables/rol/roles.phtml';