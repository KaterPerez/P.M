<?php
require_once "../models/conexion.php";
require_once "../models/mrcon.php";
require_once "cmail.php";

$mrcon = new Mrcon();

$corusu = isset($_REQUEST['corusu']) ? $_REQUEST['corusu']:NULL;

echo $corusu;
date_default_timezone_set('America/Bogota');


?>