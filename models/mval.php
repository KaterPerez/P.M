<?php
    class Mval{
        private $codval;
        private $nomval;
        private $coddom;
        // METODOS GET
        public function getCodval(){
            return $this->codval;
        }
        public function getNomval(){
            return $this->nomval;
        }
        public function getCoddom(){
            return $this->coddom;
        }
        // METODOS SET
        public function setCodval($codval){
            $this->codval=$codval;
        }
        public function setNomval($nomval){
            $this->nomval=$nomval;
        }
        public function setCoddom($coddom){
            $this->coddom=$coddom;
        }
        function getAll(){
            $sql ="SELECT codval, nomval, coddom FROM valor";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res=$result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        function getOne(){
            $sql ="SELECT codval, nomval, coddom FROM valor  WHERE codval=:codval";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $codval = $this->getCodval();
            $result->bindParam(":codval",$codval);
            $result->execute();
            $res=$result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        function save(){
            try{
                $sql ="INSERT INTO valor(codval, nomval, coddom) VALUES (:codval, :nomval, :coddom)";
                $modelo =new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $codval = $this->getCodval();
                $result->bindParam(":codval",$codval);
                $coddom = $this->getCoddom();
                $result->bindParam(":coddom",$coddom);
                $nomval = $this->getNomval();
                $result->bindParam(":nomval",$nomval);
                $result->execute();
            }catch(exception $e){
                ManejoError($e);
            }
        }
        function edit(){
            try{
            $sql ="UPDATE valor SET nomval=:nomval, coddom=:coddom WHERE codval=:codval";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $codval = $this->getCodval();
            $result->bindParam(":codval",$codval);
            $nomval = $this->getNomval();
            $result->bindParam(":nomval",$nomval);
            $coddom = $this->getCoddom();
            $result->bindParam(":coddom",$coddom);
            $result->execute();
        }catch(exception $e){
            ManejoError($e);
        }
        }
        function del(){
            try{
                $sql ="DELETE FROM valor WHERE codval=:codval";
                $modelo =new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $codval = $this->getCodval();
                $result->bindParam(":codval",$codval);
                $result->execute();
            }catch(exception $e){
                ManejoError($e);
            }
        }
    }
?>