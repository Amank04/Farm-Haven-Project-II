<?php 
$con = mysqli_connect("localhost", "root", "", "fms");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['btnSubmit']))
{
	$name = mysqli_real_escape_string($con, $_POST['txtName']);
	$email = mysqli_real_escape_string($con, $_POST['txtEmail']);
	$contact = mysqli_real_escape_string($con, $_POST['txtPhone']);
	$message = mysqli_real_escape_string($con, $_POST['txtMsg']);

//Load Composer's autoloader
require 'PHPmailer/Exception.php';
require 'PHPmailer/PHPMailer.php';
require 'PHPmailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'amankumargrd56@gmail.com';             //SMTP username
    $mail->Password   = 'mday bhim lias oxfx';                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('amankumargrd56@gmail.com', 'Contact Us');
    $mail->addAddress('amankumargrd56@gmail.com', 'Aman kumar');     //Add a recipient

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New visitor data.';
    $mail->Body    = "Sender name $name <br> Sender email $email <br> Message -$message";

    $mail->send();
    echo "<div class='success'>Message sent successfully!</div>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>
