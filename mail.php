<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'vendor/autoload.php';

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender = 'harris.faiz@digitalinteractive.com.au';
$senderName = 'DiG Website';



//Form Details

$formname = $_REQUEST['name-2'];
$formemail = $_REQUEST['email-2'];
$message = $_REQUEST['field-2'];


// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
$recipient = 'harris.faiz@digitalinteractive.com.au';

// Replace smtp_username with your Amazon SES SMTP user name.	
$usernameSmtp = 'AKIAQTXUIN5Q3S5BIJMS';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'BBRXd32adUns6oWUu3hszVwdvGpaToiBeLfqvr8PZEQl';



// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$host = 'email-smtp.ap-southeast-2.amazonaws.com';

$port = 587;

// The subject line of the email
$subject = 'Contact Submission for Digital Interactive Group Website';

// The plain-text body of the email
$bodyText =  $formname." says ".$message. "Reach them through ".$formemail;

// The HTML-formatted body of the email
$bodyHtml = '<h1>New Form Submission</h1>
    
<p> Name:'.$formname.
'</br>
Email: '.$formemail.
'</br>
Message:'.$message.' </p>';

$mail = new PHPMailer(true);

try {
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';

    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $bodyHtml;
    $mail->AltBody    = $bodyText;
    $mail->Send();
    
    echo "Email sent!";
    header('Location: index.html');

} catch (phpmailerException $e) {

    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}

?>
