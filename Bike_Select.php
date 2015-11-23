<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>iBikeHire mobile - Bike hire in Dunedin - bicycle rentals</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Book here to hire or rent a bike from ibikehire and visit some (or all) of Dunedin's attractions by bicycle"/>
        <meta name="keywords" content="dunedin, bike hire, cycle hire, rent, bike rides, cycle tours, trails cruise ship"/>

        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="stylesheet" type="text/css" href="css/bikeSelect.css"/>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <!--Datepicker-->
        <link rel="stylesheet" href="datepicker/jquery-ui-1.11.2/jquery-ui.css">
        <script src="datepicker/jquery-ui-1.11.2/jquery-ui.js"></script>

        <!--Timepicker-->
        <script src="timepicker/jquery.ui.timepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="timepicker/jquery.ui.timepicker.css"/>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.js"></script>
        <!--Validation-->
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.js"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    </head>
    <body>
            <div class="page-header" id="header">
                <a href="index.html"><h1><img src="images/ibike.png" alt="iBike logo" width="200" /></h1></a>

            </div><!-- /header -->
            <div class="container" id="mainContent">
<!--                TEST DIV
                <div id="testdiv"><table class="table table-striped">
  <caption>Population of Districts of Nepal 2013</caption>
  <thead>
   <tr>
    <th>Name</th>
    <th>Price</th>
   </tr>
  </thead>
  <tbody id="tablebody">
  </tbody>
 </table></div>
                            TEST DIV-->
                    <div id="myDiv"></div>
                <!--TEST-->
                <div id="output">
                <h1></h1>
                </div> 
                <form autocomplete="off" id='formDetails'  class ="row" role="form" action='Hire_Confirm.php' method='post'>
                    <h3>Contact Details For This Hire</h3>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="_Dname">Name:</label>
                        <input type="text" class="form-control" id="_Dname" name="_Dname" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="_Dmobile">Mobile:</label>
                        <input type="tel" class="form-control" id="_Dmobile" name="_Dmobile" placeholder="Enter Mobile Number" required>
                        <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="used if we need to contact you prior to your hire">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label" for="_Demail">Email:</label>
                        <input type="email" class="form-control" id="_Demail" name="_Demail" placeholder="Enter Email address" required>
                        <a class="popa" tabindex="0" data-trigger="focus" data-placement="bottom" data-toggle="popover" data-content="your booking confirmation will be sent to this email address">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                    </div>
                    <input type="number" id="_price" name="_price" hidden readonly>
                </form>
                <div class="Bikes">
<?php

function newBike()
{
    $json_url = "Json/bikedata.json";
    $json = file_get_contents($json_url);
    $links = json_decode($json, TRUE);
    
    
    $count1= 0;

    $count= 0;
    $CurBike=0;
    $i=0;

    echo ("<form id='form' class='form-inline top-buffer' role='form'>
        <div id='MainBikes class='row'>");
     foreach($links['bikes'] as $key=>$val)
    {
        $count1++;


         if($count1 < 2)
         {
             echo ("<div class='col-md-3'>
    <div class='bikeContent' id='bikeContent_{$count1}'>
    <label id='bikeOpt2_{$count1}'  class='bikeOpt2'>
    <input type='radio' id='bikeOpt_{$count1}'  value='". $val['Name'] ."' name='bikeSelec' class='BikeInput img-rounded'>
    <img src=images/". $val['Image'] . " width='200' alt='" . $val['Name'] . "'>
    </label>
    </div>
    <div class='bikeName'><h5><u><b>" . $val['Name'] . " $" .$val['Price'] . "/day</b></u></h5></div>");
    echo ("<div class='descrp' id='description_{$count1}'><small>" . $val['Descr'] . "</small></div>
    </div>");
         }
         else{
                     echo ("<div class='col-md-3'>
    <div class='bikeContent' id='bikeContent_{$count1}'>
    <label id='bikeOpt2_{$count1}'  class='bikeOpt2'>
    <input type='radio' id='bikeOpt_{$count1}'  value='". $val['Name'] ."' name='bikeSelec' class='BikeInput img-rounded'>
    <img src=images/". $val['Image'] . " width='200' alt='" . $val['Name'] . "'>
    </label>
    </div>
    <div class='bikeName'><h5><u><b>" . $val['Name'] . " $" .$val['Price'] . "/day</b></u></h5></div>");
    echo ("<div class='descrp descr2' id='description_{$count1}'><small>" . $val['Descr'] . "</small></div>
    </div>");
         }

         $i++;
         if ($i%4 == 0)
         {

             echo '<div class="clearfix"></div></div><div class="row">';
         }
    }
    echo ("</div>
    </form>");
}?>


<?php
function runBike()
{
    newBike();
}
runBike();
?>
<!--        <div id="section" class="col-md-12 row"></div>-->
        <div id="NHDinfo" class="top-buffer">
            <form autocomplete="off" id="Maininfo" class="" role="form">
                <div class="row top-buffer">
                    <div class="col-md-4 form-group">
                        <label class="control-label" for="_Name00">Rider:</label>
                        <input type="text" class="activeInput form-control" id="_Name00" name="_Name00" placeholder="Enter Name"  required>
                    </div>
                    <div class="col-md-4 form-group">
                       <label class="control-label" for="_Height00">Rider Height:</label>
                       <select class="activeInput form-control" id ='_Height00' name="_Height00">
                       </select>
                        <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="Used for bike sizing">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="control-label" for="Extras">Extras:</label>
                    <select class="activeInput form-control" id ='Extras' name="Extras">
                        <option value=''>None</option>
                        <option value='PBR'>Pannier Bags and Rack $10/day</option>
                        <option value='CCBT'>Childs Covered Bike Trailer $15/day</option>
                        <option value='CSFM'>Childs Seat Front Mounted $10/day</option>
                        <option value='CSRM'>Childs Seat Rear Mounted $10/day</option>
                        <option value='PEDS'>Clip Pedal/ Shimano spds $5/day</option>
                    </select>
                        <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="These will be fitted to your bike">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <div class="row top-buffer">
                <div class="col-md-3 form-group">
                    <label class="control-label col-md-12" for="NumDays">Days:</label>
                    <select class="activeInput form-control" id ='NumDays' name="NumDays">
                        <option value='0.5'>4 hours</option>
                        <option value='1'>1 day</option>
                        <option value='2'>2 days</option>
                        <option value='3'>3 days</option>
                        <option value='4'>4 days</option>
                        <option value='5'>5 days</option>
                    </select>
                    <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="1 day = 24 hrs halfday = 4hrs">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    </a>
                </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label" for="_Daddress">Delivery Address:</label>
                        <textarea rows="2" cols="20" class="form-control" id="_Daddress" name="_Daddress" placeholder="Enter Delivery Address" required>

                        </textarea>
                        <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="Must be Dunedin local address">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div class="col-md-3 form-group">
                    <label class="control-label col-md-12" for="_Date">Start Date:</label>
                        <input type="text" class="activeInput form-control" id="_Date" name="_Date" placeholder="Enter Delivery Date" required readonly>
                        <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="The first day of your hire">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                </div>
                <div class="col-md-3 form-group">
                    <label class="control-label col-md-12" for="_Time">Start Time:</label>
                        <input type="text" class="activeInput form-control" id="_Time" name="_Time" placeholder="Enter Delivery Time" required readonly>
                    <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="Delivery time - 8am to 8pm minimum notice 4hrs. If you need earlier call us">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    </a>
                </div>
                </div>
                <div class="row top-buffer">
                    <div class="col-md-4 col-md-offset-4 form-group">
                        <label class="control-label" for="_Daddress">Additional Comments (Optional):</label>
                        <textarea rows="2" cols="20" class="form-control" id="Comments" name="Comments" placeholder="Add Any Additional Comments">

                        </textarea>
                    </div>
                </div>
                    <div class="row top-buffer form-group">
                        <button type="button" class="addRider btn btn-primary" id="AddRider">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Rider</button>

                <button type="button" class="addRider btn btn-success" id="AddRiderDone">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Done</button>

                    </div>
                </form>
                    </div>
                    <!--log Riders-->
                    <div class ="row repeatingSec">
                        <div id="bgStyling">
                            <div id="RiderAdd">
                                <div class ="row repeatingSec" id="repeatingSection">
                                    <h4 class="control-label">Select Bike For Rider <span id="rID">2</span></h4>
                                    <div class="">
                                        <div role="form">
                                            <div class="form-group col-md-4">
                                                <label class="control-label">Rider (Optional):</label>
                                                <input type="text"  id="_Name1" class="activeInput2 repeatName form-control"  placeholder="Enter Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label">Height:</label>
                                                <select class="activeInput2 repeatHeight form-control" id="_Height1">
                                                </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label class="control-label">Extras:</label>
                                                <select class="activeInput repeatExtra form-control" id ='_Extras1'>
                                                    <option value=''>None</option>
                                                    <option value='PBR'>Pannier Bags and Rack $10/day</option>
                                                    <option value='CCBT'>Childs Covered Bike Trailer $15/day</option>
                                                    <option value='CSFM'>Childs Seat Front Mounted $10/day</option>
                                                    <option value='CSRM'>Childs Seat Rear Mounted $10/day</option>
                                                    <option value='PEDS'>Clip Pedal/ Shimano spds $5/day</option>
                                                </select>
                                                <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="These will be fitted to your bike">
                                                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class ="row top-buffer">
                                    <div class="col-sm-12">
                                        <button type="button" class="addRider btn btn-success" id="AddRider2">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Rider</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="EditDetails">
                                <h4 class="control-label">Edit Details and Select Bike For Rider <span id="eID"></span></h4>
                                <div role="form">
                                    <div class="">
                                        <div class="form-group col-md-4">
                                            <label class="control-label">Edit Name:</label>
                                            <input type="text"  id="_Ename" class="form-control" placeholder="Edit Name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label" for="_Eheight">Edit Height:</label>
                                            <select class="form-control" id="_Eheight">
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="control-label">Extras:</label>
                                            <select class="activeInput form-control" id ='_Extras'>
                                                <option value=''>None</option>
                                                <option value='PBR'>Pannier Bags and Rack $10/day</option>
                                                <option value='CCBT'>Childs Covered Bike Trailer $15/day</option>
                                                <option value='CSFM'>Childs Seat Front Mounted $10/day</option>
                                                <option value='CSRM'>Childs Seat Rear Mounted $10/day</option>
                                                <option value='PEDS'>Clip Pedal/ Shimano spds $5/day</option>
                                            </select>
                                            <a class="popa" tabindex="0" data-trigger="focus" data-toggle="popover" data-placement="right" data-content="These will be fitted to your bike">
                                                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="button" class="btn btn-primary" id="EditRider2">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Rider</button>
                                        <button type="button" class="btn btn-success" id="Done">Done</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="EditDetails2">
                                <h4 class="control-label">Edit Details and Select Bike For Rider <span id="eID2"></span></h4>
                                <div role="form">
                                    <div class="">
                                        <div class="form-group col-md-3">
                                            <label class="control-label">Edit Name:</label>
                                            <input type="text"  id="_Ename2" class="form-control" placeholder="Edit Name" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label" for="_Eheight200">Edit Height:</label>
                                            <select class="form-control" id="_Eheight200">
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label" for="ENumDays">Edit Days:</label>
                                            <select class="activeInput form-control" id ='ENumDays'>
                                                <option value='0.5'>4 hours</option>
                                                <option value='1'>1 day</option>
                                                <option value='2'>2 days</option>
                                                <option value='3'>3 days</option>
                                                <option value='4'>4 days</option>
                                                <option value='5'>5 days</option>
                                            </select>
                                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="control-label" >Extras:</label>
                                            <select class="activeInput form-control" id='EExtras'>
                                                <option value=''>None</option>
                                                <option value='PBR'>Pannier Bags and Rack $10/day</option>
                                                <option value='CCBT'>Childs Covered Bike Trailer $15/day</option>
                                                <option value='CSFM'>Childs Seat Front Mounted $10/day</option>
                                                <option value='CSRM'>Childs Seat Rear Mounted $10/day</option>
                                                <option value='PEDS'>Clip Pedal/ Shimano spds $5/day</option>
                                            </select>
                                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="button" class="btn btn-primary" id="EditRider3">
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Rider</button>
                                        <button type="button" class="btn btn-success" id="Done2">Done</button>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="form-group row" id="log">
                            </div>
                    </div>
                            <div class="form-group row" id="Delivlog">

                            </div>
                        <form id="EditDelivDetails">
                        <h4 class="control-label">Edit Delivery Details For this order</h4>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label class="control-label" for="_EDaddress">Edit Delivery Address:</label>
                                        <textarea rows="2" cols="20" class="form-control" id="_EDaddress" name="_EDaddress" placeholder="Enter Delivery Address" required>

                                        </textarea>
                                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label" for="_EDate">Edit Start Date:</label>
                                        <input type="text" class="activeInput form-control" id="_EDate" name="_EDate" placeholder="Enter Delivery Date" readonly required>
                                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label col-md-12" for="_ETime">Edit Start Time:</label>
                                        <input type="text" class="activeInput form-control" id="_ETime" name="_ETime" placeholder="Enter Delivery Time" readonly required>
                                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="EditDelivery">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Details</button>
                                    <button type="button" class="btn btn-success" id="EDone">Done</button>
                                </div>
                    </form>
            </div>
                </div>
        <div class ="row">
            <div id="PriceTot" class="alert alert-info col-md-2 col-md-offset-5 text-center top-buffer">
                <h4>Total Price</h4>
                <h4 id="Tprice"><!--Price--></h4>
            </div>
        </div>
        <form autocomplete="off" id='formDetails2'  class ="row top-buffer" role="form" action='Hire_Confirm.php' method='post'>
                <div class="form-group col-md-12">
                    <button type="button" name="button" id="Confirm" class="btn btn-success btn-lg" disabled>Submit</button>
                    </div>
        </form>

    <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div>
<?php
    error_reporting(0);
    $_SESSION['ConfirmInfo']=$_POST[ 'data'];
?>
                <div class="posV">

                </div>
</div>
        <div class="navbar footer col-md-3 col-md-offset-5 top-buffer">
            <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contact
            </button>

            <a href="index.html" data-icon="home" data-theme="d" class="btn btn-default btn-lg" rel="external"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
        </div>

        <script src="js/main.js"></script>
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
