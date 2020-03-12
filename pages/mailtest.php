<?php
session_start();
include('../dist/includes/dbcon.php');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// $model = "iLOQ Oval Lock Serial Number (IQ-2061-xx)";
// $maxsn = "16194999";
$model = $_GET['mod'];
$maxsn = $_GET['sn'];

emailtest($model,$maxsn);
function emailtest($model, $maxsn){
    include('../dist/includes/mail_config.php');
    //Load Composer's autoloader
    require '../vendor/autoload.php';
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $mHost;                                 // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $mUname;                          // SMTP username
        $mail->Password = $mPass;                           // SMTP password
        $mail->SMTPSecure = $mSMTP;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $mPort;         
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );                           // TCP port to connect to

        //Recipients
        $mail->setFrom($mUname, 'iLOQ Packing System');
        $mail->addAddress('muhammadfirdauss@my.beyonics.com');     // Add a recipient
        $mail->addAddress('daus_momo94@yahoo.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('tmp/overdue_tmp.csv');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'iLOQ SN Max Range Alert';
        $mail->Body    = 'Hi, <br><br>Please be alert that SN for <b>'.$model.'</b> have reached <b>'.$maxsn.'</b>.<br>';
        $mail->AltBody = 'Hi, <br><br>Please be alert that SN for <b>'.$model.'</b> have reached <b>'.$maxsn.'</b>.<br>';
        $mail->Body    .= "<br><br><i>Don't reply to this email. Please contact Admin for further information.</i>";
        $mail->AltBody .= "<br><br><i>Don't reply to this email. Please contact Admin for further information.</i>";

        $mail->send();
        // echo'<script type="text/javascript">
        // alert("Message has been sent");
        // window.history.back();
        // </script>';
    } catch (Exception $e) {
        // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        // echo'<script type="text/javascript">
        // alert("Message could not be sent.");
        // window.history.back();
        // </script>';
    }



}
?>