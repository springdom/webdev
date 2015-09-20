<?php
$newArr= $_SESSION['ConfirmInfo'];
unset($newArr[0]);
$count=0;
error_reporting(0);

$Name = $_SESSION['Name'];
$Email = $_SESSION['email'];
$mobile = $_SESSION['mobile'];
$price = $_SESSION['price'];

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
$mail->AddAddress($Email, $Name);  // Add a recipient

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'New Bike Hire Final Stage';
$mail->Body = ' ';
$mail->Body .= "<div id='Cinfo'><h1>Details for this order</h1><p>Name:$Name</p><p>Email:$Email</p><p>Mobile:$mobile</p></div>";
$mail->Body .= "<div id='Dinfo'>";
$mail->Body .= "<div class='col-md-3'><p>Address:<br>";
$mail->Body .= $_SESSION['ConfirmInfo'][0]['Address'];
$mail->Body .= "</p></div>";
$mail->Body .= "<div class='col-md-3'><p>Delivery Time:<br>";
$mail->Body .= $_SESSION['ConfirmInfo'][0]['DefaultTime'];
$mail->Body .= "</p></div>";
$mail->Body .= "<div class='col-md-3'><p>Delivery Date:<br>";
$mail->Body .= $_SESSION['ConfirmInfo'][0]['Date'];
$mail->Body .= "</p></div>";
$mail->Body .= "<div class='col-md-3'><p>Number of Days:<br>";
$mail->Body .= $_SESSION['ConfirmInfo'][0]['NumOfDays'];
$mail->Body .= "</p></div>";
$mail->Body .= "<div class='col-md-3'><p>Extras:<br>";
$mail->Body .= $_SESSION['ConfirmInfo'][0]['Extras'];
$mail->Body .= "</p></div>";
$mail->Body .= "<div class='col-md-3'><p>Comments:<br>";
$mail->Body .= $_SESSION['ConfirmInfo'][0]['Comments'];
$mail->Body .= "</p></div>";

foreach ($newArr as $item) {
    $count++;
    $mail->Body .= "<div class='text-center col-md-4'><p>";
    $mail->Body .="<b>Rider $count<br>";
    $mail->Body .= $_SESSION['ConfirmInfo'][$count]['Name'];
    $mail->Body .="</b><br>";
    $mail->Body .="<b>Bike: ";
    $mail->Body .=$_SESSION['ConfirmInfo'][$count]['Bike2'];
    $mail->Body .="</b><br>";
    $mail->Body .="Extras: ";
    $mail->Body .=$_SESSION['ConfirmInfo'][$count]['Extra2'];
    $mail->Body .=" $";
    $mail->Body .= $_SESSION['ConfirmInfo'][$count]['ExtraPVal'];
    $mail->Body .="</b><br>";
    $mail->Body .="<b>Price:$";
    $mail->Body .=$_SESSION['ConfirmInfo'][$count]['Price'];
    $mail->Body .="</b><br>";
    $mail->Body .="Height:";
    $mail->Body .=$_SESSION['ConfirmInfo'][$count]['Height'];
    $mail->Body .= "</p></div>";
}
$mail->Body .= "</div>";
$mail->Body .= "<div id='Dinfo'><p>Price Paid:$price</p></div>";
$mail->Body .= "</div>";

if(!$mail->Send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    exit;
}
//echo 'Message has been sent';
?>
