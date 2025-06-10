<?php
$to = "recipient@example.com";
$subject = "Test Email";
$message = "This is a test email sent from PHP.";

$headers = "From: sender@example.com\r\n";
$headers .= "Reply-To: sender@example.com\r\n";
$headers .= "CC: cc@example.com\r\n";
$headers .= "BCC: bcc@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully to $to";
} else {
    echo "Email sending failed.";
}
?>
