<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Enable SMTP debug (set 0 in production)
    $mail->SMTPDebug = 0; 
    $mail->Debugoutput = 'html';

    // SMTP setup for IONOS
    $mail->isSMTP();
    $mail->Host       = 'smtp.ionos.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'iam@gleeong.com';       // Your IONOS email
    $mail->Password   = 'Gonegello@15';// Use App Password if 2FA is enabled
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Sender and recipient
    $mail->setFrom('iam@gleeong.com', 'Maniniyot Customer Inquiry');
    $mail->addAddress('arnelcapillanes1000@gmail.com'); // Where messages go

    // Get form data safely
    $fullname = htmlspecialchars($_POST['fullname']);
    $email    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message  = htmlspecialchars($_POST['message']);
    $service  = htmlspecialchars($_POST['service']);
    // Reply-To (so you can reply to the user directly)
    $mail->addReplyTo($email, $fullname);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "From $fullname";
    $mail->Body = '
            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:20px; font-family:Arial,sans-serif;">
            <tr>
                <td>
                <table width="600" align="center" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                    <td style="background-color:#0073e6; color:#ffffff; padding:20px; text-align:center; font-size:24px;">
                        Service Inquiry
                    </td>
                    </tr>
                    <tr>
                    <td style="padding:20px; color:#333333; font-size:16px; line-height:1.5;">
                        <p><strong>Name:</strong> '.$fullname.'</p>
                        <p><strong>Email:</strong> '.$email.'</p>
                        <p><strong>Service:</strong><br>'.$service.'</p>
                        <p><strong>Message:</strong><br>'.$message.'</p>
                    </td>
                    </tr>
                    <tr>
                    <td style="background-color:#f4f4f4; padding:10px; text-align:center; font-size:12px; color:#777777;">
                        &copy; '.date("Y").' Your Company Name. All rights reserved.
                    </td>
                    </tr>
                </table>
                </td>
            </tr>
            </table>
            ';

    // Send email
    if($mail->send()) {
          echo "success: Message sent successfully!";
    } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>