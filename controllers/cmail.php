<?php
require_once '../models/conexion.php'; // Incluir la conexión a la base de datos
require '../vendor/autoload.php'; // Cargar PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$pdo = (new Conexion())->get_conexion(); // Obtener conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailusu = trim($_POST['email']);

    // Verificar si el correo existe y obtener nombre y apellido
    $stmt = $pdo->prepare("SELECT nomusu, apeusu FROM usuario WHERE  corusu= ?");
    $stmt->execute([$emailusu]);
    $user = $stmt->fetch();

    if ($user) {
        $nombre = htmlspecialchars($user['nomusu']);
        $apellido = htmlspecialchars($user['apeusu']);

        // Generar token único
        $token = bin2hex(random_bytes(32));

        // Insertar token con expiración de 15 minutos
        $stmt = $pdo->prepare("INSERT INTO token( corusu, token, expiracion) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 15 MINUTE))");
        $stmt->execute([$emailusu, $token]);

        // Configurar PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'danicuervo516@gmail.com';
            $mail->Password = 'jiil xsyg uqtx kmgy'; // Usa una contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('danicuervo516@gmail.com', 'Proyect Manager');
            $mail->addAddress($emailusu);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';

            // Enlace con el token
            $enlace = "http://localhost/PM-04-03/index.php?pg=300&token=" . $token;

            // Cuerpo del correo en HTML
            $mail->Body = "
                <div style='max-width: 600px; margin: auto; padding: 20px; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 10px; text-align: center;'>
                    <img alt='Project Manager' style='width: 120px; margin-bottom: 20px;'>
                    <h2 style='color: #333;'>Hola, {$nombre} {$apellido}</h2>
                    <p style='color: #555; font-size: 16px;'>Hemos recibido una solicitud para restablecer tu contraseña. Si no hiciste esta solicitud, ignora este mensaje.</p>
                    <a href='{$enlace}' 
                        style='display: inline-block; padding: 12px 20px; background-color: #007BFF; color: white; text-decoration: none; font-size: 16px; font-weight: bold; border-radius: 5px;'>
                        Restablecer Contraseña
                    </a>
                    <p style='color: #888; font-size: 14px; margin-top: 20px;'>Este enlace es válido por 15 minutos.</p>
                </div>
            ";

            $mail->send();
            echo "<script>alert('Correo enviado con éxito. Revisa tu bandeja de entrada.'); window.location.href='../index.php?pg=1002';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error al enviar el correo: {$mail->ErrorInfo}'); window.location.href='../index.php?pg=1002';</script>";
        }
    } else {
        echo "<script>alert('El correo no está registrado.'); window.location.href='../index.php?pg=1002';</script>";
    }
}
?>
