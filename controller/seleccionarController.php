<?php
    spl_autoload_register("mi_autocargador");
    require_once "model/logModel.php";
    require_once "passwordencriptadaController.php";
    require "viewController.php";

    if(isset($_POST['login'])){
        $email = htmlspecialchars($_POST['email']);
        $password = $encriptar(htmlspecialchars($_POST['password']));

        $loginModel = new Log();
        $loginModel->correo = $email;
        $loginModel->password = $password;

        $resultado = $loginModel->login();
        // session_start();
        $ruta = $_SESSION['ruta'];
        $view = new ViewController();
        $view->loadView($ruta);
        exit();
    }
?>