<?php
    require_once "model/caracterizacionModel.php";

    if(isset($_POST["crear"])){
        $id_caracterizacion = htmlspecialchars($_POST["id_caracterizacion"]);
        $altura = htmlspecialchars($_POST["altura"]);
        $peso = htmlspecialchars($_POST["peso"]);
        $diametro = htmlspecialchars($_POST["diametro_pierna"]);
        $antecedentes = htmlspecialchars($_POST["antecedentes"]);
        $puntaje = htmlspecialchars($_POST["puntaje"]);

        $caracterizacion = new Caracterizacion();
        $carac = $caracterizacion->create_caracterizacion($id_caracterizacion, $altura, $peso, $diametro, $antecedentes, $puntaje);
        require_once "view/dbTables/caracterizacion/caracterizacion.phtml";
    }else{
        require_once "view/error.phtml";
    }
