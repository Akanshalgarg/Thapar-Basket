<?php

$servername = "localhost";
$username = 'root';
$password = '';
$database = "thaparbasket";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $query = "SELECT password FROM userinfo WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result === false) {
            die("Password generation failed: " . $conn->error);
        } else {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $password = $row['password'];
                $message = "Your password is: $password"; // Include the fetched password in the email content
            } else {
                $message = "Email not found.";
            }
        }
    } else {
        $message = "Email not provided.";
    }
}

// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST["send"])) {
    // Get the email entered by the user
    $email = $_POST["email"];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'msptk23@gmail.com';
    $mail->Password = 'bqufxydbmzuordfn';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Sender and recipient
    $mail->setFrom('msptk23@gmail.com');
    $mail->addAddress($email); // Use the email entered by the user

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "Password for login";
    $mail->Body = "$message"; // Include the message containing the password or error message
    $mail->send();

    echo "
        <script>
        alert('Password sent successfully through mail');
        window.location.href = 'login.php?productid=NULL';
        </script>
    ";
} else {
    echo "Email not sent";
}
?>