<?php
    class Roles extends Conexion{
        private $rol;
        public $mensaje;
        public function __construct()
        {
            $this->rol = array();
        }

        # devolver los roles
        public function get_roles(){
            $res = parent::conectar();
            $sql = $res->prepare("SELECT * FROM rol");
            $sql->execute();
            while($reg=$sql->fetch()){
                $this->rol[] = $reg;
            }
            return $this->rol;
        }

        # devolver rol por ID
        public function get_roles_id(){
            $res = parent::conectar();
            if(!empty($_GET["valor"])){
                $id_rol = parent::comillas_inteligentes($_GET["valor"]);
                $sql = $res->prepare(sprintf("SELECT * FROM rol WHERE id_rol = $id_rol"));
                $sql->execute();
                while($reg = $sql->fetch()){
                    $this->rol[] = $reg;
                }
                return $this->rol;
            }else{
                echo("<script>alert('No existen roles registrados aún.')</script>");
            }
        }

        # actualizar ID por rol
        public function set_roles($id_rol, $nombre_rol){
            $res = parent::conectar();
            if(!empty($id_rol)){
                $sql = $res->prepare("UPDATE rol SET nombre_rol = '" .$nombre_rol. "' WHERE id_rol = " .$id_rol);
                $sql->execute();
            }
            echo("<script>alert('Rol actualizado correctamente.')</script>");

            $sql = $res->prepare("SELECT * FROM rol");
            $sql->execute();
            unset($this->rol);
            while($reg = $sql->fetch()){
                $this->rol[] = $reg;
            }
            return $this->rol;
        }

        # crear nuevo rol
        public function create_rol($id_rol, $nombre_rol){
            $res = parent::conectar();
            $sql = $res->prepare("INSERT INTO rol(id_rol, nombre_rol) VALUES (:id_rol, :nombre_rol)");
            $sql->bindParam(':id_rol', $id_rol);
            $sql->bindParam(':nombre_rol', $nombre_rol);

            if($sql->execute()){
                echo ("<script>alert('Usuario Creado con Éxito!')</script>");
            }else{
                echo ("<script>alert('Error al crear el usuario.')</script>");
            }

            $sql = $res->prepare("SELECT * FROM rol");
            $sql->execute();
            unset($this->rol);
            while($reg = $sql->fetch()){
                $this->rol[] = $reg;
            }
            return $this->rol;
        }
    }