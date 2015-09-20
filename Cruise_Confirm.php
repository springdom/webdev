<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <title>iBikeHire Mobile - Bike hire in Dunedin - bicycle rentals</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Book here to hire or rent a bike from ibikehire and visit some (or all) of Dunedin's attractions by bicycle"/>
<!-- #EndEditable -->
<meta name="keywords" content="dunedin, bike hire, cycle hire, rent, bike rides, cycle tours, trails cruise ship"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />

<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    </head>
    <body>
        <!--data-role page start-->
        <div data-role="page">
            <link rel="stylesheet" href="css/cruiseFinal.css" />
            <div data-role="header">
                <h1>
                    <img src="images/ibike.png" alt="iBike logo" width=150 />
                </h1>
                <div data-role="navbar">
                    <ul>
                        <li>
                            <a href="Cruise_Ship_Deals.php" data-transition="slide" rel="external">Cruise Deal</a>
                        </li>
                        <li>
                            <a href="Cruise_Form.php" data-transition="slide"  rel="external">Form To Complete</a>
                        </li>
                        <li>
                            <a href="Cruise_Confirm.php" data-theme="b" data-transition="slide" rel="external">Confirm and Pay</a>
                        </li>
                    </ul>
                </div>
            </div>
<h1>Step 3: Confirm And Pay</h1>
<!--div container start-->
<div id="container" style="width:device-width;
                           height:device-height;
                           background-color:white;
                           border:3px solid #000000;
                           background-color:white;">
<!--div data start-->
<div id="data">
<?php
//NOTE:Use when done
error_reporting(0);
require 'PHPMailer/PHPMailerAutoload.php';
require 'PHPMailer/class.phpmailer.php';
    $day=$_POST['selectday'];
    $month=$_POST['selectmonth'];
    $year=$_POST['selectyear'];

  $date = $day."/".$month."/".$year;
  $exp_date = str_replace('/', '-', $date);
  $_SESSION['date']=date($date);
  $todays_date = date("d-m-Y");
  $today = strtotime($todays_date);
  $date = strtotime($exp_date);

/*
   $_POST['email']!=""||
   preg_match("/$Cell/",$_POST['mobile'])&&
*/
?>
<?php
$Name="^[a-zA-ZàáâäãåąćęèéêëìíîïłńòóôöõøùúûüÿýżźñçčšžÀÁÂÄÃÅĄĆĘÈÉÊËÌÍÎÏŁŃÒÓÔÖÕØÙÚÛÜŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$";
$Cell="^[0-9]{10}$";
?>
<?php
if($date >= $today){

if(isset($_POST['submit'])&&
   $_POST['fName']!=""&&
   $_POST['ship'] != ""&&
   $_POST['height'] !=""
  ){
    if(preg_match("/$Name/",$_POST['fName'])){
    //possibly add number to date to calculate from
    //Variables
    $finalCalc = 0;
    $_SESSION['firstName2']= $_POST['fName'];
    $fName = $_SESSION['firstName2'];

    $_SESSION['email2']= $_POST['email'];
    $email = $_SESSION['email2'];

    $_SESSION['cellNumber2']=$_POST['mobile'];
    $mobile= $_SESSION['cellNumber2'];

    $_SESSION['height2']=$_POST['height'];
    $height=$_SESSION['height2'];

    $_SESSION['bikeAmount2']= $_POST['Nbikes'];
    $Nbikes=$_SESSION['bikeAmount2'];

    $day=$_POST['selectday'];
    $month=$_POST['selectmonth'];
    $year=$_POST['selectyear'];

    $date=$day."-".$month."-".$year;
    $_SESSION['date2']=date($date);

    /*$_SESSION['bikeAmount']= $_POST['Nbikes'];
    $Nbikes=$_SESSION['bikeAmount2'];*/

    $_SESSION['ship']=$_POST['ship'];
    $_SESSION['url'] = 2;
    $ship= $_SESSION['ship'];

    $Tprice= $_SESSION['total'];
    $finalCalc=sprintf("%.2f", $Tprice * $Nbikes);
    $finalCalc=sprintf("%.2f", $finalCalc);
    $_SESSION['final']=$finalCalc;
    sendMail();

//confirmation Details
echo"<form action='final.php' method='POST'>";
    echo("<h2>Please confirm your details and proceed to payment</h2><br>");
//bike selected
    switch($Tprice)
    {
    //Scott Speedster
        case 59:
        echo"<p style='color:black;'>Cruise Ship Deal selected: Dunedin By Bike $59</p>";
        $_SESSION['bikeType']="CruiseDeal59";
        break;
    //Avanti Giro
        case 35:
        echo"<p style='color:black;'>Cruise Ship Deal selected: Bike the Bays $35</p>";
        $_SESSION['bikeType']="CruiseDeal35";
        break;
    }
//name
    echo("<p>Name:</p><p>$fName</p><br/>");
    //email
    echo("<p>Email:</p><p>$email</p><br/>");
//mobile
    echo("<p>Mobile:$mobile</p><br/>");
    echo("<p>(confirmation will be sent by sms)</p><br/>");
    echo("<p>Bikes Requested:</p><p>$Nbikes</p><br/>");
    //height
    echo("<p>Rider/s Height</p><br/>");
    $M = count($height);
    $count=1;
    for($i=0; $i < $M; $i++)
    {
    echo("<p>Rider Height ".$count++.":". $height[$i]."cm</p>"."<br/>");
    }
    //delivery date
    echo("<p>Delivery Date:</p><p>$date</p><br/>");
    //delivery address
    echo("<p>Ship youre arriving on:</p><p>$ship</p><br/>");
    echo("<h1 style='text-align:center; color:black;'>TOTAL PRICE<br>$$finalCalc</h1>");
echo("<h1 style='text-align:center; color:black;'>Pay Now</h1>");
        echo"<iframe src='http://kiwipay.harmonyapp.com/iframe/?merchant=ibikehire&price={$finalCalc}&description=iBikeDunedin&name={$fName}&return_url=http://m.ibikehire.co.nz/final2.php'' style='border:none; overflow:hidden; width:100%; height:140px; margin-top: 15px;'></iframe>";
}
else
{
 if(!preg_match("/$Name/u",$_POST['fName']))
    {
    echo"Name is empty or has invalid characters<br>";
    }
    if(!preg_match("/$Cell/",$_POST['mobile']))
    {
    echo"Invalid characters entered in Mobile Number<br>";
    }
    if(empty($_POST['address']))
    {
    echo"Delivery Address is empty or has invalid characters<br>";
    }
    echo"<p class='col'>error! Required field/s missing. Please ensure that you have filled out the required details correctly</p>";
    echo"Name<br>";
    echo"Email or Mobile Number<br>";
    echo"Height<br>";
    echo"Delivery Address<br>";
    $finalCalc = sprintf("%.2f",0);
}
}
else
{
 if(!preg_match("/$Name/u",$_POST['fName']))
    {
    echo"Name is empty or has invalid characters<br>";
    }
    if(!preg_match("/$Cell/",$_POST['mobile']))
    {
    echo"Invalid characters entered in Mobile Number<br>";
    }
    if(empty($_POST['ship']))
    {
    echo"Delivery location is empty or has invalid characters<br>";
    }
    echo"<p class='col'>error! Required field/s missing. Please ensure that you have filled out the required details correctly</p>";
    echo"Name<br>";
    echo"Email or Mobile Number<br>";
    echo"Height<br>";
    echo"Delivery Address<br>";
    $finalCalc = sprintf("%.2f",0);
}
}
//valid date end
else
{
    if($date < $today){
    echo"The date you entered was invalid.<br>";}
    echo"<p class='col'>Please ensure that you have filled out the required details correctly</p>";
    echo"Name<br>";
    echo"Email or Mobile Number<br>";
    echo"Height<br>";
    echo"Delivery Address<br>";
    $finalCalc = sprintf("%.2f",0);
}
//valid date else end
?>
    <?php

function sendMail()
{

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
    $_SESSION['CruiseVar'] = array();
    array_push($_SESSION['CruiseVar'],$fname);
    array_push($_SESSION['CruiseVar'],$mobile);
    array_push($_SESSION['CruiseVar'],$height);

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

    $mail->IsHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'New Cruise Ship Confirmation Stage';
    $mail->Body   = ' ';
    $mail->Body  .= "<p>Please ensure the customer has confirmed</p>";
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
    //echo 'Message has been sent';
}

?>
    </div>
<!--div data end-->
</div>
<!--div container end-->
<!--Pay Now Button-->
    <a style="text-align:center;" href="Cruise_Form.php" data-role="button" data-theme="b" rel="external" >Go Back</a>
    <div data-role="footer" class="ui-bar" id="footer">
        <a href="index.html" data-icon="home" data-theme="d" class="ui-btn-left" rel="external">Home</a>
    </div>
</div>
    </body>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-59247001-1', 'auto');
        ga('send', 'pageview');

    </script>
</html>
