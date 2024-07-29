<?php
    class Conexion{
        private $root = __root__;
        private $password = '';
        private $host = __host__;
        private $dbname = ___dbname__;

        public function conectar(){
            try{
                $conexion = new PDO("mysql:host=" .$this->host. ";dbname=" .$this->dbname. ";port=3307;", $this->root, $this->password);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexion->query("SET NAMES utf8");
                return $conexion;
            }catch(PDOException $e){
                echo "Error: ".$e->getMessage();
            }
        }

        # ruta
        public static function ruta(){
            return "http://localhost/www/PEPAM/";
        }
        public function comillas_inteligentes($valor){
            $valor = stripslashes($valor);
            if(!is_numeric($valor)){
                $valor = "'" .mysql_real_escape_string($valor). "'";
            }
            return $valor;
        }
    }