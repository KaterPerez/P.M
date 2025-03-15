<?php
	class conexion{
        public function get_Conexion(){
            include("datos.php");
            $conexion = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
            return $conexion;
        }
    }
?>