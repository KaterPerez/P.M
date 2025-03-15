<?php
require_once 'mgrue.phh';

class GrupoController {
    private $grupo;

    $this->grupo = new Grupo($db);

    public function guardarGrupo() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $curso = $_POST['curso'];
            $nombreGrupo = $_POST['nombreGrupo'];
            $cantidadIntegrantes = $_POST['cantidadIntegrantes'];
            $integrantes = array(
                $_POST['integrante1'], 
                $_POST['integrante2'], 
                $_POST['integrante3']
            );

            $this->grupo->guardarGrupo($curso, $nombreGrupo, $cantidadIntegrantes, $integrantes);
            header("Location: /grupos");
        }
    }

    public function mostrarGrupos() {
        $grupos = $this->grupo->obtenerGrupos();
        include 'views/grupos.php';
    }

    public function eliminarGrupo($id) {
        $this->grupo->eliminarGrupo($id);
        header("Location: /grupos");
    }
}