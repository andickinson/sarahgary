<?php
// Once the form is submitted, check to ensure that the fields are not empty	 
// if (trim($_POST['attendees']) == '') {
//     $hasError = true;
// } else {
//     $attendees = trim($_POST['attendees']);
// }
// if (trim($_POST['subject']) == '') {
//     $hasError = true;
// } else {
//     $subject = trim($_POST['subject']);
// }
//Check if the email address is valid
if (trim($_POST['email']) == '') {
    $hasError = true;
} else if (!filter_var(trim($_POST['email'], FILTER_VALIDATE_EMAIL))) {
    $hasError = true;
} else {
    $email = trim($_POST['email']);
}
if (trim($_POST['attendees']) == '') {
    $hasError = true;
} else {
    if (function_exists('stripslashes')) {
        $attendees = stripslashes(trim($_POST['attendees']));
    } else {
        $attendees = trim($_POST['attendees']);
    }
}
if (trim($_POST['dietary']) == '') {
    $dietary = 'None';
} else {
    if (function_exists('stripslashes')) {
        $dietary = stripslashes(trim($_POST['dietary']));
    } else {
        $dietary = trim($_POST['dietary']);
    }
}
if (trim($_POST['attend']) == '') {
    $hasError = true;
} else {
    if (function_exists('stripslashes')) {
        $attend = stripslashes(trim($_POST['attend']));
    } else {
        $attend = trim($_POST['attend']);
    }
}
//If there is no error then send the email
if (!isset($hasError)) {
    // Now we have all the information from the fields sent by the form.
    // Replace youremail@domain.com by your email;
    $subject = 'Wedding RSVP';
    $to = 'sarahmc.chan@hotmail.com, garyrward@gmail.com, andickinson@gmail.com';
    // $to = 'andickinson@gmail.com';
    $headers = 'From: ' . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    // load email HTML template
    $body = file_get_contents('../include/email-template.html');
    // replace appropriate placeholders
    $body = str_replace('{{attend}}', $attend, $body);
    $body = str_replace('{{email}}', $email, $body);
    $body = str_replace('{{attendees}}', $attendees, $body);
    $body = str_replace('{{dietary}}', $dietary, $body);
    $body = str_replace("\n.", "\n..", $body);
    mail($to, $subject, $body, $headers); //This method sends the email.
    echo "<p class='form-submitted'><strong>RSVP sent!</strong></p>";
}
else {
    echo "<p class='form-submitted'><strong>Uh oh! It looks like there has been an error, please call 0419 153 571 for assistance.</strong></p>";
}
        
        