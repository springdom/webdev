<?php

$fName = $_SESSION['firstName2'];
$mobile= $_SESSION['cellNumber2'];
$email=$_SESSION['email2'];
$height=$_SESSION['height2'];

$date=$_SESSION['date2'];

$Nbikes=$_SESSION['bikeAmount2'];

$ship= $_SESSION['ship'];

$finalCalc=sprintf('%.2f',$_SESSION['final']);
$bikeType=$_SESSION['bikeType'];
//mail($to, $subject, $message, $headers);


$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mandrillapp.com';                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'ibike468@gmail.com';               // SMTP username
$mail->Password = 'qy04EbDGZPr4kCqKFKMMBQ';           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'info@ibikehire.co.nz';
$mail->FromName = 'Nick Beekhius';
$mail->AddAddress('info@ibikehire.co.nz', 'Nick Beekhius');  // Add a recipient
$mail->AddAddress($email, $fName);  // Add a recipient

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Cruise Ship Hire';
$mail->Body   = ' ';
$mail->Body .= "<div id='Cinfo'><h1>Details for this order</h1></div>";
$mail->Body  .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$mail->Body  .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" .strip_tags($_SESSION['firstName2']) . "</td></tr>";
$mail->Body  .= "<tr><td><strong>Mobile:</strong> </td><td>" . $mobile . "</td></tr>";
$mail->Body  .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
$mail->Body  .= "<tr><td><strong>Height:</strong> </td><td>" .print_r( $height, true ) . "</td></tr>";
$mail->Body  .= "<tr><td><strong>Delivery Date Requested:</strong> </td><td>" . $date . "</td></tr>";
$mail->Body  .= "<tr><td><strong>Amount of Bikes:</strong> </td><td>" . $Nbikes . "</td></tr>";
$mail->Body  .= "<tr><td><strong>Ship Details:</strong> </td><td>" . $ship . "</td></tr>";
$mail->Body  .= "<tr><td><strong>Price Paid:</strong> </td><td>" . $finalCalc . "</td></tr>";
$mail->Body  .= "</table>";

if(!$mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
exit;
}
?>
