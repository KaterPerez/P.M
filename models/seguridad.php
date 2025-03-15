<?php
	session_start();
	$aut = isset($_SESSION["aut"]) ? $_SESSION["aut"]:NULL;
	if(session_status()!=2 or $aut!="jY238Jn&5Hhass.??44aa@@fg(80"){
		session_destroy();
		header("Location: index.php");
		exit();
	}
	function cod($pg) {
		$resultado = NULL;
		$modelo = new conexion();
		$conexion = $modelo->get_Conexion();
		
		// Obtener el perfil del usuario
		$Codper = isset($_SESSION['codper']) ? $_SESSION['codper'] : 0;
		
		// Consultar la página permitida para este perfil
		$sql = "SELECT p.rutpag FROM pagina AS p
				INNER JOIN pagxper AS pp ON p.codpag = pp.codpag
				WHERE pp.codper = :codper AND p.codpag = :pg";
		
		$result = $conexion->prepare($sql);
		$result->bindParam(":codper", $Codper);
		$result->bindParam(":pg", $pg);
		$result->execute();
		
		$resultado = $result->fetchAll(PDO::FETCH_ASSOC);
		
		return $resultado;
	}
?>