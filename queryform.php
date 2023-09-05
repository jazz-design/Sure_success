<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recipient email address
    $to = "vichaar.team@gmail.com";
    
    // Email subject
    $subject = "Enquiry Form Detail";

    // Collecting POST data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $enquiry = $_POST["enquiry"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];
    $ilets = $_POST["ilets"];
    $refusal = $_POST["refusal"];

    // Combine all information
    $messageBody = "Name: $name\n";
    $messageBody .= "Email: $email\n";
    $messageBody .= "Enquiry: $enquiry\n";
    $messageBody .= "Phone: $phone\n";
    $messageBody .= "Country: $country\n";
    $messageBody .= "ILETS: $ilets\n";
    $messageBody .= "Refusal: $refusal\n";

    // Headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $messageBody, $headers)) {
        // Redirect to a 'Thank You' page
        header("Location: query.php?status=success");
        exit();
    } else {
        // Redirect back to the form page with an error status
        header("Location: query.php?status=error");
        exit();
    }
}
?>
