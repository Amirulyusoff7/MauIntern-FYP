<?php
include('../config.php'); // Include the database connection file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Require the Composer autoload file
require '/xampp/htdocs/vendor/autoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

if (isset($_POST['applicationID'], $_POST['internshipID'], $_POST['newStatus'])) {
    $applicationID = $_POST['applicationID'];
    $internshipID = $_POST['internshipID'];
    $newStatus = $_POST['newStatus'];

    // Update the application status in the database
    $update_status_query = "UPDATE application SET Status = '$newStatus' WHERE internshipID = '$internshipID' AND applicationID = '$applicationID'";
    if ($conn->query($update_status_query) === TRUE) {
        // Fetch the student email based on studentID
        $student_query = "SELECT s.email
                          FROM student s
                          JOIN application a ON s.studentID = a.studentID
                          WHERE a.applicationID = '$applicationID'";
        $student_result = $conn->query($student_query);
        $student_data = $student_result->fetch_assoc();
        $studentEmail = $student_data['email'];

    try {
        // Server settings for Gmail
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'amirulyusoff.study@gmail.com'; // Your Gmail email address
        $mail->Password = 'ffpfqdtldykhtoac'; // Your Gmail password or App Password if you have 2-step verification enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Set the sender and reply-to addresses
        $mail->setFrom('amirulyusoff.study@gmail.com', 'Amirul');

        // Set the recipient's email address and name
        $mail->addAddress($studentEmail, 'Recipient Name');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Internship Application Status Update';
        $mail->Body = 'Your internship application status has been updated by the company.'; // Customize the email body
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // Send the email
        if ($mail->send()) {
            echo "Message has been sent to $studentEmail<br>";
        } else {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Error updating status: " . $conn->error . "<br>";
}
}

?>