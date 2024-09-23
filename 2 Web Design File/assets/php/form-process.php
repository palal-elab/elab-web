<?php

echo '
<style>

body {
    margin: 0;
    padding: 0;
    background-image: url("/assets/img/hero-area.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    font-family: Arial, sans-serif;
}
    .message-box {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; 
        
    }

    .message-content {
        padding: 20px;
        border: 2px solid #333;
        background-color: rgba(244, 244, 244, 0.9); /* semi-transparent background to make text readable */
        text-align: center;
    }

    a {
        display: block;
        margin-top: 10px;
        color: #007BFF;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
';



$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// MSG SUBJECT
if (empty($_POST["msg_subject"])) {
    $errorMSG .= "Subject is required ";
} else {
    $msg_subject = $_POST["msg_subject"];
}

// PHONE NO
if (empty($_POST["phone_no"])) {
    $errorMSG .= "Phone number is required ";
} else {
    $phone_no = $_POST["phone_no"];
}


// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}


$EmailTo = "palal.elab@gmail.com";
$EmailTo2 = "alnahyan.elab@gmail.com";
$EmailTo3 = "contact@errorlab.com.bd";
$Subject = "E LAB - New Message Received";
$Subject1 = "E LAB - Message Received";

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Phone No: ";
$Body .= $phone_no;
$Body .= "\n";
$Body .= "Subject: ";
$Body .= $msg_subject;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

$Body1 = ""; 
$Body1 .= "Dear ";
$Body1 .= $name;
$Body1 .= ",\n" ;
$Body1 .= "Thank you for reaching out. Our team will get back to you shortly.\n" ;
$Body1 .= "\n" ;
$Body1 .= "E Lab Team." ;



$additionalHeaders = 'MIME-Version: 1.0' . "\r\n";
$additionalHeaders .= 'Content-type: text/plain; charset=utf-8' . "\r\n";
$additionalHeaders .= 'From: ' . $email . "\r\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);
$success = mail($EmailTo2, $Subject, $Body, "From:".$email);

mail($email, $Subject1, $Body1, "From:".$EmailTo3);

$message = "";
if (!$success) {
    $errorMessage = error_get_last()['message'];
    $message = "Mail could not be sent because: $errorMessage";
    // JavaScript for auto redirect after 5 seconds
    echo '<script>setTimeout(function(){ window.location.href = "http://www.errorlab.com.bd"; }, 10000);</script>';

} else if ($errorMSG == "") {
    $message = '<img src="/assets/img/logo.png" alt="Your Logo"><br>'; // Include the logo
    $message = "<h1>Message Sent Successfully! Thank you"." ".$name.", We will contact you shortly!</h1>";
    $message .= '<h3><a href="\index.html">Return To Website</a></h3>';
    // JavaScript for auto redirect after 5 seconds
    echo '<script>setTimeout(function(){ window.location.href = "http://www.errorlab.com.bd"; }, 10000);</script>';
} else {
    $message = $errorMSG;
}

// Display the message in a centered box
echo '
<div class="message-box">
    <div class="message-content">
        '.$message.'
    </div>
</div>
';


?>