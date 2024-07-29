<?php
    require_once "model/caracterizacionModel.php";
    $caracterizacion = new Caracterizacion();
    $carac = $caracterizacion->get_caracterizacion();
    require_once "view/dbTables/caracterizacion/caracterizacion.phtml";