<?php
function opti($pict, $nomimg, $rut, $pre){
	ini_set('memory_limit', '512M');
	$nombre = '';
	if($pict){
		$max_ancho = 1024;
		$max_alto = 800;
		$docext = pathinfo($pict["name"], PATHINFO_EXTENSION);
		if($docext=="png" or $docext=="jpg" or $docext=="jpeg" or $docext=="jfif"){
			$medidasimagen = getimagesize($pict['tmp_name']);
			//echo $medidasimagen[0]."-".$pict['size'];
			if($medidasimagen[0]<=$max_ancho && $pict['size']<1048576){
				$nombre = $rut.'/'.$nomimg."_".$pre.".".$docext;
				move_uploaded_file($pict['tmp_name'], $nombre);
			}else{
				$nombre = $rut.'/'.$nomimg."_".$pre.".".$docext;
				$rtOriginal=$pict['tmp_name'];
				if($pict['type']=='image/jpeg'){
					$original = imagecreatefromjpeg($rtOriginal);
				}else if($pict['type']=='image/png'){
					$original = imagecreatefrompng($rtOriginal);
				}else if($pict['type']=='image/gif'){
					$original = imagecreatefromgif($rtOriginal);
				}
				list($ancho,$alto)=getimagesize($rtOriginal);
				$x_ratio = $max_ancho / $ancho;
				$y_ratio = $max_alto / $alto;
				if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
	    			$ancho_final = $ancho;
	    			$alto_final = $alto;
				}elseif (($x_ratio * $alto) < $max_alto){
	    			$alto_final = ceil($x_ratio * $alto);
	    			$ancho_final = $max_ancho;
				}else{
	    			$ancho_final = ceil($y_ratio * $ancho);
	    			$alto_final = $max_alto;
				}
				$lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
				imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
	 			$cal=8;
	 			if($pict['type']=='image/jpeg'){
					imagejpeg($lienzo,$nombre);
				}else if($pict['type']=='image/png'){
					imagepng($lienzo,$nombre);
				}else if($pict['type']=='image/gif'){
					imagegif($lienzo,$nombre);
				}
			}
		}elseif ($docext=="mp4" or $docext=="mov" or $docext=="avi") {
			if($pict['size']<100741824){
				$nombre = $rut.'/'."Vid_".$nomimg."_".$pre.".".$docext;
				move_uploaded_file($pict['tmp_name'], $nombre);
			}else{
				echo "<script>alert('Los archivos de video debe tener un peso maximo de 97Mb');</script>";
			}	
		}elseif ($docext=="xls" or $docext=="xlsx") {
			if($pict['size']<1048576){
				$nombre = $rut.'/'."fic_".$nomimg."_".$pre.".".$docext;
				move_uploaded_file($pict['tmp_name'], $nombre);
			}else{
				echo "<script>alert('Los archivos de Excel debe tener un peso maximo de 97Mb');</script>";
			}	
		}else{
			echo "<script>alert('Solo se permiten archivos de extensiones: png, jpg, jpeg, mp4, mov, avi.');</script>";
		}
	}
	return $nombre;
}
function ManejoError($e){
    if(strpos($e->getMessage(),'1451')){
        echo '<script>err("No se puede eliminar este registro. Por que se encuentra relacionado en otra opción.");</script>';
    }elseif(strpos($e->getMessage(),'1062')){
        echo '<script>err("Registro duplicado. Intente nuevamente con otro número de identificación ó comuníquese con el administrador del sistema.");</script>';
    }else{
        echo '<script>err("Se generó un error comuníquese con el administrador del sistema.");</script>';
    }
}

function arrstr($dt){
    $txt = "";
    if($dt){ foreach ($dt as $d) {
        $txt .= $d['idpag'].",";
    }}
    return $txt;
}
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
		$txt .= "";
	$txt .= "</div>";
	return $txt;
}

function titulo2($tx="Sin titulo",$mos=1){
	$txt = "<div class='tit'>";
		$txt .= "<h1>";
			if($mos==1){
	            //$txt .= '<div class="titaju">';
	                $tx .= '<i class="fa-solid fa-circle-plus" id="mas" onclick="ocul('.$mos.',1);" style="margin-left: 20px;color: #ffffff;text-shadow: 0px 0px 5px #117f09, 0px 0px 5px #117f09, 0px 0px 5px #117f09;"></i>';
	                $tx .= '<i class="fa-solid fa-circle-minus" id="menos" onclick="ocul('.$mos.');" style="margin-left: 20px;color: #ffffff;text-shadow: 0px 0px 5px #117f09, 0px 0px 5px #117f09, 0px 0px 5px #117f09;"></i>';
	            //$txt .= '</div>';
	        }
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
		$txt .= '<a href="index.php?pg=205&vid='.$pg.'" target="_blank" title="Ver Ayuda">';
			$txt .= '<i ';
            if($pg==1405) $txt .='style="color:white;"';
            $txt .=' class="fa-solid fa-circle-question fa-2x btnhelp"  title="Ver Ayuda"></i>';
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
    }

function firdig($nomusu, $idasi, $fec, $tip){
	$html = "";
	if($tip==1){
		$html .= "<table border='0' cellspacing='0' cellpadding='2' style='user-select: none;background-image: url(\"../img/fonfir.png\");'><tr><td style='width: 140px;text-align: right;'>";
			$html .= $nomusu;
		$html .= "</td><td style='width: 128px;border-left: 1px dashed #000;font-size: 8px;'>";
			$html .= "Firmado Digitalmente ";
			$html .= "No.: ".str_pad($idasi,6,"0", STR_PAD_LEFT)."<br>";
			$html .= "Fecha: ".substr($fec,0,10)."<br>";
			$html .= "Hora: ".substr($fec,11,8);
		$html .= "</td></tr></table>";
	}elseif($tip==2){
		$html .= "<table border='0' cellspacing='0' cellpadding='2' style='user-select: none;background-image: url(\"../img/fonfir.png\");'><tr><td style='width: 140px;text-align: center;'>";
			$html .= $nomusu;
		$html .= "</td></tr></table>";
	}elseif($tip==3){
		$html .= "<table border='0' cellspacing='0' cellpadding='2' style='user-select: none;background-image: url(\"../img/fonfir.png\");'><tr><td style='width: 128px;font-size: 7px;text-align: left:'>";
			$html .= "Firmado Digitalmente ";
			$html .= "No.: ".str_pad($idasi,5,"0", STR_PAD_LEFT)."<br>";
			$html .= "Fecha: ".substr($fec,0,10)."<br>";
			$html .= "Hora: ".substr($fec,11,8);
		$html .= "</td></tr></table>";
	}
	return $html;
}
?>