<?php include  'config/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function SendEmailReset($userName, $email, $token)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.mandrillapp.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'Versavvy';                     //SMTP username
        $mail->Password   = 'suix_AfDtCSptGlAsRIXNQ';                               //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('noreplay@versaavy.com', 'Aklile G');
        $mail->addAddress($email, $userName);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'TOMOCA Admin Portal';
        $mail->Body    = 'Hello ' . $userName . '</b> You are seeing this up on your request to reset password. to reset your password please press the link: 
        <a href="http://localhost/BackAdmin/ChangePassword.php?tokan=' . $token . '&email=' . $email . '"> Click here  </a> </b> ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients ' . $token;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['Reset_user'])) {

    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $token = md5(rand());


    $query = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
    $existance = mysqli_query($connection, $query);


    if (mysqli_num_rows($existance) > 0) {
        $row = mysqli_fetch_array($existance);
        $shopName = $row['Shop_name'];
        $userName = $row['UserName'];

        $query2 = "UPDATE admin SET V_token= '$token' WHERE email= '$email' LIMIT 1";
        $Res = mysqli_query($connection, $query2);

        if ($Res) {
            SendEmailReset($userName, $email, $token);
        } else {

            $_SESSION['status'] = "Some thing went wrong";
            // header("Location: forgot-password.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No Email Found";
        header("Location: forgot-password.php");
        exit(0);
    }

    echo $row['UserName'];
    echo $email;
    // echo $token;
}
