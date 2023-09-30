


<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
{
    require('mailer/PHPMailer.php');
    require('mailer/SMTP.php');
    require('mailer/Exception.php');

    $mail = new PHPMailer(true);


    try {
        //Server settings
                          
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ashupra73@gmail.com';                     //SMTP username
        $mail->Password   = 'hwhg qund yqbz mjnc';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('ashupra73@gmail.com', 'Hacker');
        $mail->addAddress($email);     //Add a recipient
      

       
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password reset confirmation';
        $mail->Body    = "we got a password request from you <br>
        Click the link below <br>
        <a href='http://localhost:8000/new/testt/temp/pa.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



$server = "localhost";
$user = "root";
$password = "123456";
$dbname = "task";
$con = mysqli_connect($server, $user, $password, $dbname);

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);


    $emailquery = "select * from record where email = '$email' LIMIT 1";

    $query = mysqli_query($con, $emailquery);

    $emailcount = mysqli_num_rows($query);

    if ($emailcount > 0) {
        $reset_token = bin2hex(random_bytes(16));
        date_default_timezone_set('Asia/kolkata');
        $date = date("Y-m-d");
        $up_query = "UPDATE `record` SET `token` = '$reset_token', `resettokenexpire` = '$date' WHERE `email` = '$email'";



        if (mysqli_query($con, $up_query) && sendMail($email, $reset_token)) {

            echo "mail send";
        } else {
            echo "token update faliure";
        }
    } else {
        echo "faliure";
    }
}

?>