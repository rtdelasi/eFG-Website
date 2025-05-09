<?php
// Add this at the very top to ensure it's handling POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 405 Method Not Allowed");
    exit("405 Method Not Allowed - Only POST requests are allowed");
}

// Rest of your email processing code
$name = $_POST['fullName'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// Basic validation
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    exit("Please fill all required fields");
}

// Sanitize inputs
$name = htmlspecialchars($name);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars($message);

// Send email
$to = "rdtamakloe1@gmail.com";
$subject = "Clan Registration";
$body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";
$headers = "From: $email";

if (mail($to, $subject, $body, $headers)) {
    // Success - redirect or display success message
    header("Location: thank_you.html");
} else {
    http_response_code(500);
    exit("Failed to send email. Please try again later.");
}
?>