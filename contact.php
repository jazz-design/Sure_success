<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recipient email address
    $to = "vichaar.team@gmail.com";

    // Email subject
    $subject = "Contact Us Form Submission";

    // Sanitize and Validate POST data
    $name = $_POST["name"];
    $email =$_POST["email"];
    $option = $_POST["option"];
    $message = $_POST["message"];

    // Check if any field is empty or email is invalid
    if (empty($name) || empty($email) || empty($option) || empty($message) || !$email) {
        header("Location: contact-us.php?status=error");
        exit();
    }

    // Combining all the information
    $fullMessage = "Option: $option \n Message: $message";

    // Headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // HTML email template
    $htmlContent = "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Contact Form Email</title>
    </head>
    <body>
        <h1>{$name} contacting us.</h1>
        <p>Dear,</p>
        <p>{$fullMessage}</p>
        <p>Best regards,</p>
        <p>{$email}</p>
    </body>
    </html>";

    // Sending the email
    if (mail($to, $subject, $htmlContent, $headers)) {
        header("Location: contact-us.php?status=success");
        exit();
    } else {
        header("Location: contact-us.php?status=error");
        exit();
    }
}
?>
