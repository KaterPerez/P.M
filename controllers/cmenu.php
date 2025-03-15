<?php
include_once "models/mmenu.php"; 
// Inicia la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica que 'codper' esté en la sesión antes de asignarlo
if (isset($_SESSION['codper']) && is_numeric($_SESSION['codper']) && $_SESSION['codper'] > 0) {
    $mmenu = new Mmenu();
    $mmenu->setCodper($_SESSION['codper']); // Configura el perfil del usuario actual
} else {
    echo "Error: 'codper' no está configurado correctamente en la sesión.";
    exit;
}

// Obtén el menú en el orden especificado por ordpag
$dat = $mmenu->getMenu();

// Inicializa $dtAll antes de su uso
$dtAll = [];

if (!empty($dat)) {
    $dtAll = $dat; 
}

// Función para validar una página específica
function validarPagina($codpag) {
    $mmenu = new Mmenu();
    $mmenu->setCodpag($codpag);
    
    // Verifica que 'codper' esté configurado correctamente antes de usarlo
    if (isset($_SESSION['codper']) && is_numeric($_SESSION['codper']) && $_SESSION['codper'] > 0) {
        $mmenu->setCodper($_SESSION['codper']);
    } else {
        echo "Error: 'codper' no está configurado correctamente en la sesión.";
        exit;
    }
    
    return $mmenu->getValid();
}
$sessionInfo = [];
if (isset($_SESSION['nomusu'], $_SESSION['apeusu'], $_SESSION['nomper'])) {
    $sessionInfo = [
        'usuario' => $_SESSION['nomusu'] . ' ' . $_SESSION['apeusu'],
        'perfil' => $_SESSION['nomper'],
    ];
} else {
    $sessionInfo = [
        'error' => 'No hay sesión activa',
    ];
}


?>


