<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json"); // Respuesta en formato JSON

require_once '../models/conexion.php';
require_once '../models/datos.php'; // Ajusta la ruta si es necesario

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validar que el reCAPTCHA existe
        if (!isset($_POST["g-recaptcha-response"])) {
            echo json_encode(["status" => "error", "message" => "reCAPTCHA no fue enviado."]);
            exit;
        }

        // Clave secreta (mejor guardarla en un archivo seguro)
        $recaptcha_secret = "6LeAIwcrAAAAAKZGqdZUl0byyqqCYIc3t2OG7WvJ"; 
        $recaptcha_response = $_POST["g-recaptcha-response"];

        // Verificar reCAPTCHA con Google
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            "secret" => $recaptcha_secret,
            "response" => $recaptcha_response,
            "remoteip" => $_SERVER["REMOTE_ADDR"]
        ];

        $options = [
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded",
                "method" => "POST",
                "content" => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);

        if (!$response["success"]) {
            echo json_encode(["status" => "error", "message" => "Error de verificación reCAPTCHA."]);
            exit;
        }

        // Recibir y limpiar los datos
        $nombres = trim($_POST["nombre"]);
        $apellidos = trim($_POST["apellidos"]);
        $correo = trim($_POST["email"]);
        $telefono = trim($_POST["telefono"]);
        $perfil = intval($_POST["perfil"]); // 1 = Estudiante, 2 = Profesor
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Encriptar contraseña

        // Conectar a la base de datos usando la clase conexion
        $db = new conexion();
        $conn = $db->get_Conexion();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verificar si el correo ya está registrado
        $stmt = $conn->prepare("SELECT idusu FROM usuario WHERE corusu = :correo");
        $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "El correo ya está registrado."]);
            exit;
        }

        // Insertar usuario
        $sql = "INSERT INTO usuario (nomusu, apeusu, corusu, telusu, pasusu, codper, actusu) 
                VALUES (:nomusu, :apeusu, :corusu, :telusu, :pasusu, :codper, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nomusu", $nombres, PDO::PARAM_STR);
        $stmt->bindParam(":apeusu", $apellidos, PDO::PARAM_STR);
        $stmt->bindParam(":corusu", $correo, PDO::PARAM_STR);
        $stmt->bindParam(":telusu", $telefono, PDO::PARAM_INT);
        $stmt->bindParam(":pasusu", $password, PDO::PARAM_STR);
        $stmt->bindParam(":codper", $perfil, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Registro exitoso."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar el usuario."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error en la base de datos: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Acceso no permitido."]);
}
?>
