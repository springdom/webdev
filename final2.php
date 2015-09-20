<?php
session_start();
if(empty($_SESSION['CruiseVar']))
{
    Redirect('Cruise_Ship_Deals.php', false);
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
        <link rel="stylesheet" type="text/css" href="css/bikeSelect.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
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
            <h1><img src="images/ibike.png" alt="iBike logo" width="180px" /></h1>
            <div  role="navigation">
                <ul class="nav nav-pills nav-justified">
                    <li role="presentation"><a href="index.html">Home</a></li>
                    <li role="presentation" ><a href="#">Cruise Ship Deals</a></li>
                    <li role="presentation" class="active"><a href="#">Hire Confirmation</a></li>
                </ul>
            </div>
        </div>
        <div class="container" id="mainContent">
            <p class='lead' style='color:white !importaint;'>Thank your for your payment<br>
                bike will be delivered <br> minimum 2hrs notice
                Return home or Contact Us Now</p>
            <?php
            require 'PHPMailer/PHPMailerAutoload.php';
            require 'PHPMailer/class.phpmailer.php';
            require 'mail/CruiseFin.php';
            ?>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg posV" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title text-info" id="myModalLabel">Contact Us Now</h4>
                    </div>
                    <div class="modal-body text-info">
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
    <?php
session_destroy();
    ?>
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
