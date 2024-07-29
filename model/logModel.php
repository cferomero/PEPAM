<?php
    class Log extends Conexion{
        private $user;
        
        public function __construct(){
            $this->user = array();
        }
        public $admin;
        public $usuario;
        public $id_usuario;
        public $nombre;
        public $apellidos;
        public $correo;
        public $password;
        public $mensaje;

        # crear usuario
        public function create_usuarios($id, $nombre, $apellidos, $email, $password){
            $res = parent::conectar();
            $sql = $res->prepare("INSERT INTO usuarios(id_usuario,nombre,apellidos,email,clave) VALUES(:id, :nombre, :apellidos, :email, :password)");
            $sql->bindParam(':id', $id);
            $sql->bindParam(':nombre',$nombre);
            $sql->bindParam(':apellidos',$apellidos);
            $sql->bindParam(':email',$email);
            $sql->bindParam(':password',$password);
        
            if ($sql->execute()) {
                echo ("<script>alert('Usuario Creado con Éxito!')</script>");
            } else {
                echo ("<script>alert('Error al crear el usuario.')</script>");
            }

            // definiendo los argumento en la funcion rol_default()
            $this->rol_default($id, $nombre, $apellidos);

            $sql=$res->prepare("SELECT * FROM usuarios");
			$sql->execute();
			unset($this->user);
			while($reg=$sql->fetch()){
				$this->user[]=$reg;
			}
			return $this->user;
        }

        private function rol_default($id, $nombre, $apellidos){
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

        # iniciar session
        public function login(){
            $res = parent::conectar();
            $sql = 'SELECT * FROM usuarios WHERE ';
            $sql .= 'email = :email AND clave = :password';
            $consulta = $res->prepare($sql);
            $consulta->bindParam(':email', $this->correo, PDO::PARAM_STR);
            $consulta->bindParam(':password', $this->password, PDO::PARAM_STR);
            $consulta->execute();
            $total = $consulta->rowCount();

            if($total == 0){
                return array('success' => false, 'message' => 'Error, usuario inválido.');
            }else{
                $this->mensaje = 'Usuario válido';
                $fila = $consulta->fetch();

                //session_start();
                $_SESSION['login'] = true;
                $_SESSION['id_usuario'] = $fila['id_usuario'];
                $_SESSION['nombre'] = $fila['nombre'];
                $_SESSION['apellidos'] = $fila['apellidos'];
                $_SESSION['correo'] = $fila['email'];
                $_SESSION['clave'] = $fila['clave'];

                # roles de los usuario
                $sql_roles = "SELECT r.nombre_rol FROM usuarios_roles as ur INNER JOIN rol r ON ur.id_rol = r.id_rol WHERE ur.id_usuario = ?";
                $statement = $res->prepare($sql_roles);
                $statement->bindParam(1, $_SESSION['id_usuario'], PDO::PARAM_INT);
                $statement->execute();
                $roles = $statement->fetchAll(PDO::FETCH_COLUMN);

                if(in_array('administrador', $roles)){
                    $resultado = 'administrador';
                }elseif(in_array('usuario', $roles)){
                    $resultado = 'usuario';
                }else{
                    $resultado = 'otro';
                }

                if($resultado === 'administrador'){
                    $ruta = '../view/dashboard';
                }elseif($resultado === 'usuario'){
                    $ruta = '../view/inicio';
                }else{
                    return array('Exito' => false, 'mensaje' => 'Error, rol inválido.');
                }
                # session ruta
                $_SESSION['ruta'] = $ruta;

            }
        }
    }
?>