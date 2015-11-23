<?php
//session_start();
require_once __DIR__ . '/swipe/config.php';
if(empty($_SESSION['ConfirmInfo']))
{

    Redirect('Bike_Select.php', false);
}
function Redirect($url, $permanent = false)
{
    header('Location:'.$url,true,$permanent ? 301 : 302);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>iBikeHire mobile - Bike hire in Dunedin - bicycle rentals</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Book here to hire or rent a bike from ibikehire and visit some (or all) of Dunedin's attractions by bicycle" />
    <meta name="keywords" content="dunedin, bike hire, cycle hire, rent, bike rides, cycle tours, trails cruise ship" />
    <!--        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />-->
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/hireconfirm.css" />
    <!--        <link rel="stylesheet" type="text/css" href="css/bootstrapp.css"/>-->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--        Valid-->
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
</head>
<body>
    <div class="page-header" id="header">
        <a href="index.html"><h1><img src="images/ibike.png" alt="iBike logo" width="200" /></h1></a>
        <div  role="navigation">
            <ul class="nav nav-pills nav-justified">
                <li role="presentation"><a href="index.html" class="CustA"><h4 class="CustA">Home</h4></a></li>
                <li role="presentation"><a href="Bike_Select.php" class="CustA"><h4 class="CustA">Bike Selection</h4></a></li>
                <li role="presentation" class="active"><a href="#"><h4>Hire Confirmation</h4></a></li>
            </ul>
        </div>
    </div><!-- /header -->
    <?php
        require 'PHPMailer/PHPMailerAutoload.php';
        require 'PHPMailer/class.phpmailer.php';
        //require 'mail/emailConf.php';
    ?>
    <div class="col-md-12 text-center">
        <h1>Confirm Your Details</h1>
    </div>
    <div class="container" id="MainDetails">
            <div id="ContactDetails" class='panel panel-info text-center'>
                <div class='panel-heading'>
                    <h3 class="text-center">Contact Details</h3>
                </div><div class='panel-body'>
    <?php
    $_SESSION['Name'] = $_POST['_Dname'];
    $_SESSION['email'] = $_POST['_Demail'];
    $_SESSION['mobile'] = $_POST['_Dmobile'];
    $_SESSION['price'] = $_POST['_price'];
    //$_SESSION['Comments'] = $_POST['Comments'];
    $_SESSION['url'] = 0;

    echo ("<div class='col-md-4'><p>Name<br>$_POST[_Dname]</p></div>");
    echo ("<div class='col-md-4'><p>Mobile<br>$_POST[_Dmobile]</p></div>");
    echo ("<div class='col-md-4'><p>Email<br>$_POST[_Demail]</p></div>");
    ?>
                </div></div>
            <div id="DeliveryInfo" class='panel panel-info text-center'>
                <div class='panel-heading'>
                    <h3 class="text-center">Delivery details</h3>
                </div><div class='panel-body'>
        <?php
    echo("<div class='col-md-4'><p>Delivery Address<br>");echo($_SESSION['ConfirmInfo'][0]['Address']);echo("</p></div>");
    echo"<div class='col-md-4'><p>Delivery Time<br>";echo($_SESSION['ConfirmInfo'][0]['DefaultTime']);echo"</p></div>";
    echo"<div class='col-md-4'><p>Delivery Date<br>";echo($_SESSION['ConfirmInfo'][0]['Date']);echo"</p></div>";
    echo"<div class='col-md-12'><p>Comments<br>";echo($_SESSION['ConfirmInfo'][0]['Comments']);echo"</p></div>";
        ?>
        </div>
        </div>
        <div id="RiderInfo">
        <?php
    $newArr= $_SESSION['ConfirmInfo'];
    unset($newArr[0]);
    error_reporting(0);
            $count=0;

        if($_SESSION['ConfirmInfo'][0]['NumOfDays'] == 0.5)
        {
echo("<div class='panel panel-info'>
<div class='panel-heading'>
<h3 class='text-center'>Riders Details</h3>
</div><div class='panel-body'>");
        echo "<div class='text-center col-md-4'><p>";
        echo"<b>Rider 1<br>";
        echo($_SESSION['ConfirmInfo'][1]['Name']);
        echo"</b><br>";
        echo"<b>Bike: ";
        echo($_SESSION['ConfirmInfo'][1]['Bike2']);
        echo"</b><br>";
        echo"<b>Height: ";
        echo($_SESSION['ConfirmInfo'][1]['Height']);
        echo"</b><br>";
        echo"<b>Extras: ";
        echo($_SESSION['ConfirmInfo'][0]['Extras']);
        echo" $";
        echo($_SESSION['ConfirmInfo'][0]['ExtrasPrice']);
        echo"</b><br>";
        echo"<b>Days: ";
        echo"4 hours";
        echo"</b><br>";
        echo"<b>Price: $";
        echo($_SESSION['ConfirmInfo'][1]['Price']);
        echo"</b><br>";
        echo "</p></div>";
        foreach ($newArr as $item) {
            $count++;
            if($count > 1)
            {

            echo "<div class='text-center col-md-4'><p>";
            echo"<b>Rider $count<br>";
            echo($_SESSION['ConfirmInfo'][$count]['Name']);
                echo"</b><br>";
            echo"<b>Bike: ";
            echo($_SESSION['ConfirmInfo'][$count]['Bike2']);
                 echo"</b><br>";
            echo"<b>Height:";
            echo($_SESSION['ConfirmInfo'][$count]['Height']);
                echo"</b><br>";
            echo"<b>Price: $";
            echo($_SESSION['ConfirmInfo'][$count]['Price']);
            echo"</b>";
            echo "</p></div>";
            }
        }
        echo"</div>
        </div>";
        }
        else
        {
        echo("<div class='panel panel-info'>
<div class='panel-heading'>
<h3 class='text-center'>Riders Details</h3>
</div><div class='panel-body'>");
        echo "<div class='text-center col-md-4'><p>";
        echo"<b>Rider 1<br>";
        echo($_SESSION['ConfirmInfo'][1]['Name']);
        echo"</b><br>";
        echo"<b>Bike: ";
        echo($_SESSION['ConfirmInfo'][1]['Bike2']);
        echo"</b><br>";
        echo"<b>Height: ";
        echo($_SESSION['ConfirmInfo'][1]['Height']);
        echo"cm</b><br>";
        echo"<b>Extras: ";
        echo($_SESSION['ConfirmInfo'][0]['Extras']);
        echo" $";
        echo($_SESSION['ConfirmInfo'][0]['ExtrasPrice']);
        echo"</b><br>";
        echo"<b>Days: ";
        echo($_SESSION['ConfirmInfo'][0]['NumOfDays']);
        echo" day/s";
        echo"</b><br>";
        echo"<b>Price: $";
        echo($_SESSION['ConfirmInfo'][1]['Price']);
        echo"</b><br>";
        echo "</p></div>";
        foreach ($newArr as $item) {
            $count++;
            if($count > 1)
            {

            echo "<div class='text-center col-md-4'><p>";
            echo"<b>Rider $count<br>";
            echo($_SESSION['ConfirmInfo'][$count]['Name']);
                echo"</b><br>";
            echo"<b>Bike: ";
            echo($_SESSION['ConfirmInfo'][$count]['Bike2']);
                 echo"</b><br>";
            echo"<b>Height:";
            echo($_SESSION['ConfirmInfo'][$count]['Height']);
            echo"cm</b><br>";
            echo"<b>Price:$";
            echo($_SESSION['ConfirmInfo'][$count]['Price']);
                echo"</b><br>";
            echo"Extras: ";
            echo($_SESSION['ConfirmInfo'][$count]['Extra2']);
            echo" $";
            echo($_SESSION['ConfirmInfo'][$count]['ExtraPVal']);
            echo "</p></div>";
            }
        }
        echo"</div>
        </div>";
        }
        ?>
    </div>
        <div class ="row">
            <div id="PriceTot" class="alert alert-info col-md-2 col-md-offset-5 text-center">
                <h4>Total Price</h4>
                <?php
                echo("<h4><b>$$_POST[_price]</b></h4>");
                ?>
            </div>
        </div>
        <div id="PayNow" class="row bg-info">
            <?php
            $finalCalc = $_POST[_price];
            $fName = $_POST[_Dname];
            $email = $_POST[_Demail];
           $mobile = $_POST[_Dmobile];

        //Swipe
        function post_to_url($url, $data) {
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
        $html = curl_exec ($ch);
        if (curl_errno($ch) !== 0)
        {
         curl_close ($ch);
         return false;
        }
        curl_close ($ch);
        return $html;
        }

    $postData = array(
     "api_key" => "9ddf64d63ad2a93f684f53b6b58ffb22a503e5678338090081d2b2cbb2fb033b",
     "merchant_id" => "124310DDB2B2D0",
     "td_user_data"=>"$_POST[_Dname]",
     "td_email"=>"$_POST[_Demail]",
     "td_phone"=>"$_POST[_Dmobile]",
     "td_item" => "Bike Hire",
     "td_amount" => $_POST[_price],
     "td_description" => "Brief description of my product",
     );

    $result = post_to_url("https://api.swipehq.com/createTransactionIdentifier.php", $postData);

    $test = json_decode($result,true);
    $test = array_values($test);
    //print_r($test[2]['identifier']);

            ?>

            <div id="SwipeButton" class="col-md-12 row text-center" style="padding: 52px;">
        <a class='btn btn-primary btn-lg' href='https://payment.swipehq.com/?identifier_id=<?php print_r($test[2]['identifier']); ?>'>
        Make Payment
        </a>
                </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title text-info text-center" id="myModalLabel">Contact Us Now</h4>
                    </div>
                    <div class="modal-body text-info text-center">
                        <p class="text-info">For bicycle hire in Dunedin Free phone iBike Hire at:</p>
                        <h3>0800-480-680</h3>
                        <p class="text-info">If calling outside of New Zealand:</p>
                        <h3>+64-211-750-832</h3>
                        <p class="text-info">Or email us at </p>
                        <h3>info@ibikehire.co.nz</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar footer col-md-3 col-md-offset-5">
        <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contact
        </button>

        <a href="index.html" data-icon="home" data-theme="d" class="btn btn-default btn-lg" rel="external"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Return Home</a>
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
