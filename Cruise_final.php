<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>iBikeHire Mobile - Bike hire in Dunedin - bicycle rentals</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Book here to hire or rent a bike from ibikehire and visit some (or all) of Dunedin's attractions by bicycle"/>
<!-- #EndEditable -->
<meta name="keywords" content="dunedin, bike hire, cycle hire, rent, bike rides, cycle tours, trails cruise ship"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
        <meta charset="UTF-8">
    </head>
<body>
<div data-role="page">
        <style>
            .ui-page{
            background: #00ABE3;
            }
            .ui-page {
            background: #00ABE3;
            }
            #footer {
            height:25px;
            }
            p
            {
            text-align:center;
            }
        </style>
    <div data-role="header">
                <h1>
                    <img src="images/ibike.png" alt="iBike logo" width=150 />
                </h1>
                <div data-role="navbar">
                    <ul>
                        <li>
                            <a href="bikeselect.php" data-transition="slide" rel="external" class="ui-disabled">Bike Selection</a>
                        </li>
                        <li>
                            <a href="hireform.php" data-transition="slide"  rel="external" class="ui-disabled">Form To Complete</a>
                        </li>
                        <li>
                            <a href="hireconfirm.php" data-transition="slide" rel="external" class="ui-disabled">Confirm and Pay</a>
                        </li>
                    </ul>
                </div>
    <div data-role="content">

<?php
error_reporting(0);
require 'PHPMailer/PHPMailerAutoload.php';
require 'PHPMailer/class.phpmailer.php';
echo"<p>Thank your for your payment<br>
bike will be delivered <br> minimum 2hrs notice
Return home Contact Us Now<br></p>";

if(($_SESSION['firstName'] != "")&&($_SESSION['cellNumber'] != "")||($_SESSION['email'] != "")&&($_SESSION['final']!=0)&&($_SESSION['bikeAmount']!=0)&&($_SESSION['ship'] != ""))
{
    $fName = $_SESSION['firstName'];
    $mobile= $_SESSION['cellNumber'];
    $email=$_SESSION['email'];
    $height=$_SESSION['height'];

    $date=$_SESSION['date'];

    $Nbikes=$_SESSION['bikeAmount'];

    $ship= $_SESSION['ship'];

    $finalCalc=sprintf('%.2f',$_SESSION['final']);
    $bikeType=$_SESSION['bikeType'];

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
    $mail->AddAddress('taylomj5@gmail.com', 'Nick Beekhius');  // Add a recipient

    $mail->IsHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'New Cruise Ship Confirmation Stage';
    $mail->Body   = ' ';
    $mail->Body  .= "<p>Please ensure the customer has confirmed</p>";
    $mail->Body  .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $mail->Body  .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" $fName "</td></tr>";
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
        <?php
}
else
{
    echo"<p class='col'>error! Required field/s missing. Please ensure that you have filled out the required details</p>";
    echo"Name<br>";
    echo"Email or Mobile Number<br>";
    echo"Height<br>";
    echo"Delivery Address<br>";
    $finalCalc = sprintf("%.2f",0);
    echo"<a style='text-align:center;' href='Bike_Select.php' data-role='button' data-theme='b'>Go Back</a>";
}
    ?>
<p>Any Issues?</p>
<a style="text-align:center; text-transform:uppercase;" href="Contact_Now.html" data-role="button" data-icon="arrow-r" data-iconpos="right" data-theme="b" >Contact Us Now!</a>
<!--Return Home button-->
    </div>
</div>
    <div data-role="footer" class="ui-bar" id="footer">
        <a href="index.html" data-icon="home" data-theme="d" class="ui-btn-left" rel="external">Return Home</a>
    </div>
    </body>
</html>
