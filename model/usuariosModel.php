<?php
    class Usuarios extends Conexion{
        private $user;
        public $mensaje;
        public function __construct(){
            $this->user= array();
        }

        # devolver todos los usuarios
        public function get_usuarios(){
            $res = parent::conectar();
            $sql = $res->prepare("SELECT * FROM usuarios");
            $sql->execute();
            while($reg=$sql->fetch()){
                $this->user[] = $reg;
            }
            return $this->user;
        }

        # devolver usuario por ID
        public function get_usuarios_id(){
            $res = parent::conectar();
            if(!empty($_GET["valor"])){
                $id = parent::comillas_inteligentes($_GET["valor"]);
                $sql = $res->prepare(sprintf("SELECT * FROM usuarios WHERE id_usuario = $id"));
                $sql->execute();
                while($reg = $sql->fetch()){
                    $this->user[] = $reg;
                }
                return $this->user;
            }else{
                echo("<script>alert('No existen usuarios registrados aún.')</script>");
            }
        }

        # actualizaer el usuario por el ID
        public function set_usuarios($id, $nombre, $apellidos, $correo,$clave, $edad, $celular, $id_carac, $estado){
            $res = parent::conectar();
            if(!empty($id)){
                // $sql = $res->prepare("UPDATE usuarios SET nombre ='".$nombre."',apellidos='" .$apellidos."',email='" .$correo. "' WHERE id_usuario=" .$id. ";");
                $sql = $res->prepare("UPDATE usuarios SET nombre ='".$nombre."',apellidos='" .$apellidos."',email='" .$correo. "',edad='" .$edad. "',celular='" .$celular. "',c_idcarac='" .$id_carac. "',estado='" .$estado. "'WHERE id_usuario=" .$id. ";");
                $sql->execute();
            }
            echo("<script>alert('Usuario actualizado.')</script>");

            $sql = $res->prepare("SELECT * FROM usuarios");
            $sql->execute();
            unset($this->user);
            while($reg = $sql->fetch()){
                $this->user[] = $reg;
            }
            return $this->user;
        }

        # eliminar usuario
        public function delete_usuarios($id){
            $res = parent::conectar();
            if(!empty($id)){
                $sql = $res->prepare("DELETE FROM usuarios WHERE id_usuario =" .$id. ";");
                $sql->execute();
            }else{
                echo("<script>alert('No existen registros para borrar.')</script>");
            }

            $sql = $res->prepare("SELECT * FROM usuarios");
            $sql->execute();
            unset($this->user);
            while($reg = $sql->fetch()){
                $this->user[] = $reg;
            }
            return $this->user;
        }

        # crear usuario
        public function create_usuarios($id, $nombre, $apellidos, $correo, $clave){
            $res = parent::conectar();
            $sql = $res->prepare("INSERT INTO usuarios(id_usuario,nombre,apellidos,email,clave) VALUES(:id, :nombre, :apellidos, :email, :password)");
            $sql->bindParam(':id', $id);
            $sql->bindParam(':nombre',$nombre);
            $sql->bindParam(':apellidos',$apellidos);
            $sql->bindParam(':email',$correo);
            $sql->bindParam(':password',$clave);
        
            if ($sql->execute()) {
                echo ("<script>alert('Usuario Creado con Éxito!')</script>");
            } else {
                echo ("<script>alert('Error al crear el usuario.')</script>");
            }

            $this->rol_default($id, $nombre, $apellidos);

            $sql=$res->prepare("SELECT * FROM usuarios");
			$sql->execute();
			unset($this->user);
			while($reg=$sql->fetch()){
				$this->user[]=$reg;
			}
			return $this->user;
        }
        private function rol_default($id,$nombre, $apellidos){
            $conexion = parent::conectar();
            $rol_por_default = 2;
            $sql_roles_usuarios = "INSERT INTO usuarios_roles(id_usuario, nombre, apellidos, id_rol) VALUES(:id_usuario, :nombre, :apellidos, :id_rol)";
            $consulta_roles = $conexion->prepare($sql_roles_usuarios);
            $consulta_roles->bindParam(':id_usuario', $id);
            $consulta_roles->bindParam(':nombre', $nombre);
            $consulta_roles->bindParam(':apellidos', $apellidos);
            $consulta_roles->bindParam(':id_rol', $rol_por_default);

            if($consulta_roles->execute()){
                $this->mensaje = 'Rol asignado.';
            }else{
                $this->mensaje = 'Error con el rol asignado.' . implode(', ', $consulta_roles->errorInfo());
            }
        }
    }