<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta charset="UTF-8">
        <title>iBikeHire Mobile - Cruise Ship Deals</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="Cruise ship passengers - hire/rent a bike from ibikehire and visit some (or all) of Dunedin's attractions by bicycle"/>
<!-- #EndEditable -->
<meta name="keywords" content="dunedin, bike hire, cycle hire, rent, bike rides, cycle tours, trails cruise ship"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="stylesheet" type="text/css" href="css/cruiseShip.css"/>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.js"></script>
    </head>
    <body>
    <div data-role="page">
<?php
$_SESSION['Bvalue']=0;
?>
        <div id="header">
            <div id="logowrap">
                <a href="index.html">
                    <img src="images/ibike.png" alt="iBike logo" />
                </a>
            </div>
        </div>

        <div data-role="content" id="mainContent" >
            <h1>Cruise Ship Deals</h1>
            <p>Planning your Dunedin excursion shore excursion?
                <br>Discover it by Bike!
                <br>We meet you at your cruise ship with a bike and map</p>
            <p>Select and book now.</p>
            <div id="bgStyling" class="quik">
    <!--//TODO:Make selectable use photoshop to place price in images-->
<!--Validate form with javascript-->

                <form action='Cruise_Form.php' method='POST' data-ajax="false">
    <fieldset>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panelEdit"><h4><b>Dunedin By Bike</b></h4></div>
                <div class="panel-body panelBodyEdit">
                    <div class="col-md-2">
                        <img alt='Bike-ride Otago Peninsula' height='135' src='images/Heritage2.jpg' width='135'/>
                    </div>
                    <div class="col-md-8">
                    <h4>All DOWNHILL!!!</h4>
                    <p>Bike through NZ's oldest city<br>
                        visit its heritage buildings<br>
                        parks, beaches and museums.<br>
                        (Aprox. 2 hrs biking time)</p>
                </div>
                </div>
            </div>
            <input type='submit' name='submit' value ='Book Now!' class='btn btn-primary btn-lg' rel="external" data-ajax="false" />
            <!--more  info on this here-->
            <a href='dbb.html' data-role='button' data-transition='slidedown' data-rel='dialog'>More info on Dunedin Bike Cruise</a>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panelEdit"><h4><b>Bike The Bays</b></h4></div>
                <div class="panel-body panelBodyEdit">
                    <div class="col-md-2">
                        <img alt='Bike-ride Dunedin heritage' height='135' src='images/route-52.png' width='135'/>
                    </div>
                    <div class="col-md-8">
                    <h4>NO HILLS!!!</h4>
                    <p>Fantastic harbour views Quiet, Visit stunning Armoana beach with a chance of rare wildlife.<br>
                        (Aprox. 2 hrs biking time) </p>
                </div>
                </div>
            </div>
            <input type='submit' name='submit2' value ='Book Now!' class='btn btn-primary btn-lg' rel="external" data-ajax="false" />
            <!--more  info on this here-->
            <a href='btb.html' data-role='button' data-transition='slidedown' data-rel='dialog'>More info on Bike The Bays</a>
        </div>


    </fieldset>
    </form>
            </div>

    <h4 style="text-align:center; text-transform:uppercase;color:white">Queries about Cycling in Dunedin?</h4>
            <a   href="#" data-icon="arrow-r" data-role="button" data-theme="b" data-iconpos="right" data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contact
            </a>
    </div>
        <!-- Modal -->
        <div class="modal fade text-center" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title text-info" id="myModalLabel"> Contact Us Now</h4>
                    </div>
                    <div class="modal-body text-info">
                        <p class="text-info">For bicycle hire in Dunedin Free phone iBike Hire at:</p>
                        <a href="tel:0800-480-680"><h3>0800-480-680</h3></a>
                        <p class="text-info">If calling outside of New Zealand:</p>
                        <a href="tel:+64-211-750-832"><h3>+64-211-750-832</h3></a>
                        <p class="text-info">Or email us at </p>
                        <a href="mailto:info@ibikehire.co.nz"><h3>info@ibikehire.co.nz</h3></a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <div class="navbar footer">
        <a href="index.html" data-icon="home" data-theme="d" class="btn btn-default" rel="external"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
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
