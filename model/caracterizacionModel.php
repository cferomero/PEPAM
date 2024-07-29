<?php
    class Caracterizacion extends Conexion {
        private $carac;
        public $mensaje;
        public function __construct()
        {
            $this->carac = array();
        }

        # devolver los datos de la caracterizacion
        public function get_caracterizacion(){
            $res = parent::conectar();
            $sql = $res->prepare("SELECT * FROM caracterizacion");
            $sql->execute();
            while($reg = $sql->fetch()){
                $this->carac[] = $reg;
            }
            return $this->carac;
        }

        # devolver los datos de la caracterizacion por ID
        public function get_caracterizacion_id(){
            $res = parent::conectar();
            if(!empty($_GET["valor"])){
                $id_carac = parent::comillas_inteligentes($_GET["valor"]);
                $sql = $res->prepare(sprintf("SELECT * FROM caracterizacion WHERE id_caracterizacion = $id_carac"));
                $sql->execute();
                while($reg = $sql->fetch()){
                    $this->carac[] = $reg;
                }
                return $this->carac;
            }else{
                echo("<script>alert('No existen caracterizaciones aún.')</script>");
            }
        }

        # actualizar la caracterizacion por ID
        public function set_caracterizacion($id_carac, $altura, $peso, $diametro, $antecedentes, $puntaje){
            $res = parent::conectar();
            if(!empty($id_carac)){
                $sql = $res->prepare("UPDATE caracterizacion SET altura = '" .$altura. "',peso = '" .$peso. "',diametro_pierna = '" .$diametro. "'antecedentes = '" .$antecedentes. "',puntaje = '" .$puntaje. "'WHERE id_caracterizacion =" .$id_carac. ";");
                $sql->execute();
            }
            echo("<script>alert('Caracterización de usuaario actualizada.')</script>");

            $sql = $res->prepare("SELECT * FROM caracterizacion");
            $sql->execute();
            unset($this->carac);
            while($reg = $sql->fetch()){
                $this->carac[] = $reg;
            }
            return $this->carac;
        }

        # crear caracterizacion
        public function create_caracterizacion($id_carac, $altura, $peso, $diametro, $antecedentes, $puntaje){
            $res = parent::conectar();
            $sql = $res->prepare("INSERT INTO caracterizacion(id_caracterizacion,altura,peso,diametro_pierna,antecedentes,puntaje) VALUES(:id_carac, :altura, :peso, :diametro, :antecedentes, :puntaje)");
            $sql->bindParam(':id_carac',$id_carac);
            $sql->bindParam(':altura',$altura);
            $sql->bindParam(':peso',$peso);
            $sql->bindParam(':diametro',$diametro);
            $sql->bindParam(':antecedentes',$antecedentes);
            $sql->bindParam(':puntaje',$puntaje);

            if($sql->execute()){
                echo ("<script>alert('¡Caracterización creada con Éxito!')</script>");
            }else{
                echo ("<script>alert('¡No se pudo crear la caracterización del usuario!')</script>");
            }

            $this->update_id_caracterizacion($id_carac);
            $sql = $res->prepare("SELECT * FROM caracterizacion");
            $sql->execute();
            unset($this->carac);
            while($reg = $sql->fetch()){
                $this->carac[] = $reg;
            }
            return $this->carac;
        }

        private function update_id_caracterizacion($id_carac, $id_usuario){
            $conexion = parent::conectar();
            $sql = $conexion->prepare("UPDATE usuarios SET c_idcarac='" .$id_carac. "'WHERE c_id_carac =" .$id_usuario. ";");
            // $sql = $conexion->prepare("INSERT INTO usuarios(c_idcarac) VALUES (:id_carac)");
            // $sql->bindParam(':id_carac', $id_carac);
            $sql->execute();
        }
    }