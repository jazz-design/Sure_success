<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/Exception.php";
require "phpmailer/PHPMailer.php";
require "phpmailer/SMTP.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collecting POST data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $enquiry = $_POST["enquiry"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];
    $ilets = $_POST["ilets"];
    $refusal = $_POST["refusal"];

    // Check if any field is empty or email is invalid
    if (empty($name) || empty($email) || empty($enquiry) || empty($phone) || !$email) {
        header("Location: query.php?status=error");
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
        $mail->Subject = 'Enquiry Form Sure Success';

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
                    <td><b>Enquiry About:</b></td><td>{$enquiry}</td>
                </tr>
                <tr>
                    <td><b>Email:</b></td><td>{$email}</td>
                </tr>
                <tr>
                    <td><b>Phone number:</b></td><td>{$phone}</td>
                </tr>
                <tr>
                    <td><b>Country:</b></td><td>{$country}</td>
                </tr>
                <tr>
                    <td><b>ILETS:</b></td><td>{$ilets}</td>
                </tr>
                <tr>
                    <td><b>Any Refusal of Visa:</b></td><td>{$refusal}</td>
                </tr>
            </table>
        </body>
        </html>";

        $mail->Body = $htmlContent;


        // Send email
        $mail->send();
            header("Location: query.php?status=success");
            exit();
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;  // Display the error
            header("Location: query.php?status=error");  // Comment this out temporarily to see the error
            exit();
        }
}
?>
