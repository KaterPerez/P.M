<?php
function opti($pict, $nomimg, $rut, $pre) {
    ini_set('memory_limit', '512M'); // Aumentar límite de memoria para imágenes grandes
    $nombre = '';

    if ($pict) {
        $max_ancho = 1024;
        $max_alto = 800;
        $docext = pathinfo($pict["name"], PATHINFO_EXTENSION);

        if ($docext == "png" || $docext == "jpg" || $docext == "jpeg" || $docext == "jfif") {
            $directorio = __DIR__ . '/../' . $rut;

            // Crear directorio si no existe
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }

            $nombre = $directorio . '/' . $nomimg . "_" . $pre . "." . $docext;

            if (!move_uploaded_file($pict['tmp_name'], $nombre)) {
                error_log("Error al mover el archivo: " . $pict['tmp_name'] . " a $nombre");
            }
        }
    }

    return $nombre;
}


/*
function titulo($tx="Sin titulo"){
	$txt = "<div class='tit'>";
		$txt .= "<h1>";
			$txt .= '<button id="mos" class="btnven" onclick="ocultar(\'inherit\');">';
				$txt .= '<i class="fa-solid fa-plus"></i>';
			$txt .= '</button>';
			$txt .= '<button id="cer" class="btnven" onclick="ocultar(\'none\');">';
				$txt .= '<i class="fa-solid fa-minus"></i>';
			$txt .= '</button>';
			$txt .= $tx;
		$txt .= "</h1>";
		$txt .= "<hr class='lintit'>";
	$txt .= "</div>";
	return $txt;
}

function titulo2($tx="Sin titulo"){
	$txt = "<div class='tit'>";
		$txt .= "<h1>";
			$txt .= $tx;
		$txt .= "</h1>";
		$txt .= "<hr class='lintit'>";
	$txt .= "</div>";
	return $txt;
}

function titulo3($tx="Sin titulo"){
	$txt = "<h1 class='tinew'>";
		$txt .= $tx;
	$txt .= "</h1>";
	$txt .= "<hr class='lintit'>";
	return $txt;
}

function ayuda($pg){
	$txt = '<div class="btnayu">';
		$txt .= '<a href="index.php?pg=205&vid='.$pg.'" target="_blank" style="text-decoration: none;text-shadow: 0px 0px 2px #000;" title="Ver Ayuda">';
			$txt .= '<i class="fa-solid fa-circle-question fa-2x"  title="Ver Ayuda"></i>';
		$txt .= '</a>';
	$txt .= '</div>';
	return $txt;
}

//Datos de maquina maquina
function txtVisita(){
        //Si que quiere ignorar la propia IP escribirla aquí, esto se podría automatizar
        $ip="mi.ip.";
        $new_ip=get_client_ip();

        if ($new_ip!==$ip){
            $now = new DateTime();

        $txt =  str_pad($new_ip,25)." ".str_pad(ip_info($new_ip, "Country"),25);
        // $txt =  str_pad($new_ip,25)." ".
        //         str_pad($now->format('Y-m-d H:i:s'),25)." ".
        //         str_pad(ip_info($new_ip, "Country"),25);

        //$myfile = file_put_contents($archivo, $txt.PHP_EOL , FILE_APPEND);
        return $txt;
        }
    }

    //Obtiene la IP del cliente
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    //Obtiene la info de la IP del cliente desde geoplugin
    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }*/
?>