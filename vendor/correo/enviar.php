<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

require_once "../../clases/conexion.php";
$obj= new conectar();
$conexion=$obj->conexion();

$usr=$_POST["form-correo"];


$sql="select count(id) from usuario 
where email='$usr'";

$resulter=mysqli_query($conexion,$sql);
$mostrare=mysqli_fetch_row($resulter);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

if($mostrare[0]==1){
try {
    //Server settings
    $mail->SMTPDebug = 0    ;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'landtravelhn@gmail.com';                     // SMTP username
    $mail->Password   = 'contra2020';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('landtravelHN@gmail.com', 'LANDTRAVEL');
    $mail->addAddress($_POST["form-correo"], 'Usuario');     // Add a recipient

    // Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Recuperacion de Credenciales';

    
$sql="select contrasenia,email from usuario
where email='$usr'";
$result=mysqli_query($conexion,$sql);
$mostrar=mysqli_fetch_row($result);

    $mail->Body    = 'La credencial para acceder a su cuenta en LANDTRAVEL es Correo:<b>'.$mostrar[1].'</b> Contraseña:<b>'.$mostrar[0].'</b>';

    $mail->send();
    header("Location: ../../public/Olvidar-Contrasenia-correcto.php");
} catch (Exception $e) {
    echo "Hubo un error: {$mail->ErrorInfo}";
}
}else{
    echo "No existe ese correo";
}

?>