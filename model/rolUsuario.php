<?php
    class rolUsuario extends Conexion{
        private $rolUser;
        public function __construct()
        {
            $this->rolUser = array();
        }

        # devolver los usuarios
        public function get_rol_usuario(){
            $res = parent::conectar();
            $sql = $res->prepare("SELECT * FROM usuarios_roles");
            $sql->execute();
            while($reg = $sql->fetch()){
                $this->rolUser[] = $reg;
            }
            return $this->rolUser;
        }

        # devolver rol del usuario por ID
        public function get_rol_usuario_id(){
            $res = parent::conectar();
            if(!empty($_GET["valor"])){
                $id_usuario = parent::comillas_inteligentes($_GET["valor"]);
                $sql = $res->prepare(sprintf("SELECT * FROM usuarios_roles WHERE id_usuario = $id_usuario"));
                $sql->execute();
                while($reg = $sql->fetch()){
                    $this->rolUser[] = $reg;
                }
                return $this->rolUser;
            }else{
                echo("<script>alert('No existen roles de usuarios registrados aún.')</script>");
            }
        }

        # actualizar el rol
        public function set_rol_usuario($id_usuario, $id_rol){
            $res = parent::conectar();
            if(!empty($id_rol)){
                $sql = $res->prepare("UPDATE usuarios_roles SET id_rol = '" .$id_rol. "' WHERE id_usuario = " .$id_usuario. ";");
                $sql->execute();
            }
            echo("<script>alert('Rol de usuario actualizado.')</script>");
        }
    }