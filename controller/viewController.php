<?php
    class ViewController{
        public function loadView($viewName, $data=[]){
            $viewPath = __DIR__ .DIRECTORY_SEPARATOR. $viewName. '.phtml';

            if(file_exists($viewPath)){
                extract($data);
                require_once($viewPath);
            }else{
                echo "La vista '$viewName' no se encuentra.";
            }
        }
    }
?>