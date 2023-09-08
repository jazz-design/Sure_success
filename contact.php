<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/Exception.php";
require "phpmailer/PHPMailer.php";
require "phpmailer/SMTP.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and Validate POST data
    $name = strip_tags($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $option = strip_tags($_POST["option"]);
    $message = strip_tags($_POST["message"]);


    // Check if any field is empty or email is invalid
    if (empty($name) || empty($email) || empty($option) || empty($message) || !$email) {
        header("Location: contact-us.php?status=error");
            exit();
        exit();
    }

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'vichaar.team@gmail.com';  // Use your SMTP username
        $mail->Password = 'rptxtapxyixchipd';  // Use your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        //$mail->setFrom('vichaar.team@gmail.com');
        $mail->addAddress('vichaar.team@gmail.com', 'Vichaar.team');  

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Sure Success';

        // HTML Content
        $htmlContent = "
        <html>
        <head>
            <title>Contact Form Email</title>
        </head>
        <body>
            <table width='95%' border='1' cellspacing='1' cellpadding='1' align='center'>
                <tr>
                    <td><b>Sure Success Contact Enquiry Detail</b></td>
                </tr>
                <tr>
                    <td><b>Name:</b></td><td>{$name}</td>
                </tr>
                <tr>
                    <td><b>Option Choosen:</b></td><td>{$option}</td>
                </tr>
                <tr>
                    <td><b>Email:</b></td><td>{$email}</td>
                </tr>
                <tr>
                    <td><b>Message:</b></td><td>{$message}</td>
                </tr>
            </table>
        </body>
        </html>";

        $mail->Body = $htmlContent;


        // Send email
        $mail->send();
            header("Location: contact-us.php?status=success");
            exit();
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;  // Display the error
            header("Location: contact-us.php?status=error");  // Comment this out temporarily to see the error
            exit();
        }
}
?>