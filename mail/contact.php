<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'Jkristine029@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'OHOHLALALALALA996'; // Replace with your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Content
        $mail->setFrom('your-email@gmail.com', 'Your Name');
        $mail->addAddress('Jkristine029@gmail.com', 'Your Name'); // Where you want to receive the email
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Subject:</strong> $subject<br><strong>Message:</strong><br>$message";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Error: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
