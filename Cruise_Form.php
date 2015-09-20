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
         <link rel="stylesheet" type="text/css" href="css/cruiseForm.css" />
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script src="js/index.js"></script>
    </head>
<body>
    <div data-role="page">
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
                            <a href="Cruise_Form.php" data-transition="slide" data-theme="b"  rel="external">Form To Complete</a>
                        </li>
                        <li>
                            <a href="Cruise_Confirm.php" class="ui-disabled" data-transition="slide" rel="external">Confirm and Pay</a>
                        </li>
                    </ul>
                </div>
<!-- /navbar -->
</div>
<!-- /header -->
    <a style="text-align:center; text-transform:uppercase;" href="Contact_Now.html" data-role="button" data-icon="arrow-r" data-iconpos="right" data-theme="b" >Contact Us Now!</a>
<!--divMaincomtent start-->
<div data-role="content" id="mainContent">
<?php
error_reporting(0);
$_SESSION['firstName2']="";
$_SESSION['cellNumber2']="";
$_SESSION['height2']="";
$_SESSION['date2']="";
$_SESSION['bikeAmount2']=0;
$_SESSION['daysAmount2']=0;
$_SESSION['ship']="";
$_SESSION['accessories2']="";
$_SESSION['final']=0;
//TODO:JS or PHP to validate form
if(isset($_POST['submit']) ||isset($_POST['submit2'])||$_SESSION['total']!=0)
    {
    $price=$_POST['booking'];
    $_SESSION['total']=0;
//SESSION in value
//start div bike
echo("<div id='bike_descr' style='text-align:right;'>");
//$price switch start
    if(isset($_POST['submit']))
    {
    $_SESSION['total']=59;
    }
    if(isset($_POST['submit2']))
    {
    $_SESSION['total']=45;
    }
echo("</div>");
//end div
echo"<h1>Step 2: Please Complete Form</h1>";
    $self = htmlentities($_SERVER['PHP_SELF']);
//form start
echo("<p style='text-align:right;'>* = required fields</p>");
    echo("
    <form action = 'Cruise_Confirm.php' method='POST' name='form1'>
    <fieldset>");
//Full Name
    echo"<label for='text-basic'>Full Name:*</label>
             <input name='fName' id='text-basic' value='' type='text' placeholder='' required>";
    echo"<label for='text-basic'>Email:*</label>
    <input name='email' id='text-basic' value='' type='text' placeholder=''>";
//Mobile Number
    echo"<label for='tel'>Mobile:*</label>
             <input type='tel' name='mobile' id='tel' value='' type='tel' onkeypress='return isNumberKey(event)' maxlength='10'>";
    echo"<br>";

    echo"<label for='number-pattern'>No. of bikes(maximum of 6 bikes):*</label>";
echo"<select name='Nbikes' id='number-pattern' required>
     <option value='1'>1 Bike</option>
     <option value='2'>2 Bikes</option>
     <option value='3'>3 Bikes</option>
     <option value='4'>4 Bikes</option>
     <option value='5'>5 Bikes</option>
     <option value='6'>6 Bikes</option>
</select>";

//height start
    echo"

    <label for='height1'>Please enter your Height(cm)</label>
    <div id='input1' style='margin-bottom:4px;' class='clonedInput'>
       Height:<input name='height[]' id='height1' value=''type='number' maxlength='3' onkeypress='return isNumberKey(event)' max='250' required>
    </div>

    <div>
        <input type='button' id='btnAdd' data-icon='plus' data-theme='b' value='add additional riders height' />
        <input type='button' id='btnDel' data-icon='minus'  data-theme='b' value='remove additonal height' />
    </div>";
//height end
    echo"<br>";
//Delivery date and time
//Date start
echo"<label>when will you arrive</label><br>";
$day=date("d");
$day=$day + 1;
$month=date("m");
$year=date("y");
?>
    <div class='ui-block-b'>
    <label for='Sday'>Day</label>
    <select name='selectday' id='Sday'>
    <option value='01'<?php if($day=="1") { echo 'selected="selected"'; } else { echo ''; } ?>>1</option>
    <option value='02'<?php if($day=="2") { echo 'selected="selected"'; } else { echo ''; } ?>>2</option>
    <option value='03'<?php if($day=="3") { echo 'selected="selected"'; } else { echo ''; } ?>>3</option>
    <option value='04'<?php if($day=="4") { echo 'selected="selected"'; } else { echo ''; } ?>>4</option>
    <option value='05'<?php if($day=="5") { echo 'selected="selected"'; } else { echo ''; } ?>>5</option>
    <option value='06'<?php if($day=="6") { echo 'selected="selected"'; } else { echo ''; } ?>>6</option>
    <option value='07'<?php if($day=="7") { echo 'selected="selected"'; } else { echo ''; } ?>>7</option>
    <option value='08'<?php if($day=="8") { echo 'selected="selected"'; } else { echo ''; } ?>>8</option>
    <option value='09'<?php if($day=="9") { echo 'selected="selected"'; } else { echo ''; } ?>>9</option>
    <option value='10'<?php if($day=="10") { echo 'selected="selected"'; } else { echo ''; } ?>>10</option>
    <option value='11'<?php if($day=="11") { echo 'selected="selected"'; } else { echo ''; } ?>>11</option>
    <option value='12'<?php if($day=="12") { echo 'selected="selected"'; } else { echo ''; } ?>>12</option>
    <option value='13'<?php if($day=="13") { echo 'selected="selected"'; } else { echo ''; } ?>>13</option>
    <option value='14'<?php if($day=="14") { echo 'selected="selected"'; } else { echo ''; } ?>>14</option>
    <option value='15'<?php if($day=="15") { echo 'selected="selected"'; } else { echo ''; } ?>>15</option>
    <option value='16'<?php if($day=="16") { echo 'selected="selected"'; } else { echo ''; } ?>>16</option>
    <option value='17'<?php if($day=="17") { echo 'selected="selected"'; } else { echo ''; } ?>>17</option>
    <option value='18'<?php if($day=="18") { echo 'selected="selected"'; } else { echo ''; } ?>>18</option>
    <option value='19' <?php if($day=="19") { echo 'selected="selected"'; } else { echo ''; } ?>>19</option>
    <option value='20'<?php if($day=="20") { echo 'selected="selected"'; } else { echo ''; } ?>>20</option>
    <option value='21'<?php if($day=="21") { echo 'selected="selected"'; } else { echo ''; } ?>>21</option>
    <option value='22'<?php if($day=="22") { echo 'selected="selected"'; } else { echo ''; } ?>>22</option>
    <option value='23'<?php if($day=="23") { echo 'selected="selected"'; } else { echo ''; } ?>>23</option>
    <option value='24'<?php if($day=="24") { echo 'selected="selected"'; } else { echo ''; } ?>>24</option>
    <option value='25'<?php if($day=="25") { echo 'selected="selected"'; } else { echo ''; } ?>>25</option>
    <option value='26'<?php if($day=="26") { echo 'selected="selected"'; } else { echo ''; } ?>>26</option>
    <option value='27'<?php if($day=="27") { echo 'selected="selected"'; } else { echo ''; } ?>>27</option>
    <option value='28'<?php if($day=="28") { echo 'selected="selected"'; } else { echo ''; } ?>>28</option>
    <option value='29'<?php if($day=="29") { echo 'selected="selected"'; } else { echo ''; } ?>>29</option>
    <option value='30'<?php if($day=="30") { echo 'selected="selected"'; } else { echo ''; } ?>>30</option>
    <option value='31'<?php if($day=="31") { echo 'selected="selected"'; } else { echo ''; } ?>>31</option>
    </select>
    </div>
<fieldset class='ui-grid-b'>
    <div class='ui-block-a'>
    <label for='Smonth'>Month</label>
    <select name='selectmonth' id='Smonth'>
    <option value='01'<?php if($month=="1") { echo 'selected="selected"'; } else { echo ''; } ?>>Jan</option>
    <option value='02' <?php if($month=="2") { echo 'selected="selected"'; } else { echo ''; } ?>>Feb</option>
    <option value='03'<?php if($month=="3") { echo 'selected="selected"'; } else { echo ''; } ?>>Mar</option>
    <option value='04'<?php if($month=="4") { echo 'selected="selected"'; } else { echo ''; } ?>>Apr</option>
    <option value='05'<?php if($month=="5") { echo 'selected="selected"'; } else { echo ''; } ?>>May</option>
    <option value='06'<?php if($month=="6") { echo 'selected="selected"'; } else { echo ''; } ?>>Jun</option>
    <option value='07'<?php if($month=="7") { echo 'selected="selected"'; } else { echo ''; } ?>>Jul</option>
    <option value='08'<?php if($month=="8") { echo 'selected="selected"'; } else { echo ''; } ?>>Aug</option>
    <option value='09'<?php if($month=="9") { echo 'selected="selected"'; } else { echo ''; } ?>>Sep</option>
    <option value='10'<?php if($month=="10") { echo 'selected="selected"'; } else { echo ''; } ?>>Oct</option>
    <option value='11'<?php if($month=="11") { echo 'selected="selected"'; } else { echo ''; } ?>>Nov</option>
    <option value='12'<?php if($month=="12") { echo 'selected="selected"'; } else { echo ''; } ?>>Dec</option>
    </select>
    </div>
    <div class='ui-block-c'>
    <label for='Syear'>Year</label>
<select name='selectyear' id='Syear'>
<option value='2015'<?php if($year=="2015") { echo 'selected="selected"'; } else { echo ''; } ?>>2015</option>
<option value='2016'<?php if($year=="2016") { echo 'selected="selected"'; } else { echo ''; } ?>>2016</option>
<option value='2016'<?php if($year=="2016") { echo 'selected="selected"'; } else { echo ''; } ?>>2017</option>
</select>
    </div>
</fieldset>
<?php
//address
    echo("
    <fieldset>
        <legend>What ship will you be arriving on</legend>");
        echo"<span>Ship Details*</span><input type='text' name='ship' required/>";
//Terms and conditions
    echo"&nbsp;";
    echo"
    <p style='text-align:center;'>By clicking Next I accept iBike Hire Terms and Conditions<br>
         <a href='tandc.html' target='_blank' style='color:red; font-size:12px;'>View Terms and Conditions here</a></p>";
    echo"&nbsp;";
    echo"<input type='submit' name='submit' value ='Next' class='butn' data-theme='b'>";
    echo("</fieldset>
    </form>");
//form end on sbmut
    }
    else
    {
    echo"<p class='pfont'>Please Select a Cruise Ship Deal</p>";
    }
?>
<a style="text-align:center;" href="Cruise_Ship_Deals.php" data-role="button" data-theme="b" rel="external" >Go Back</a>
    </div>
<div data-role="footer" class="ui-bar" id="footer">
<a href="index.html" data-icon="home" data-theme="d" class="ui-btn-left" rel="external">Return Home</a>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $('#btnDel' ).attr('disabled', true);
            $('#btnAdd').click(function() {

                var num     = $('.clonedInput').length;
                var newNum  = new Number(num + 1);
                var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
                $('#btnDel' ).attr('disabled', false);

                newElem.children(':first').attr('name','id' + newNum).attr('height', 'height' + newNum);
                $('#input' + num).after(newElem);

                if (newNum == 7)
                    $('#btnAdd' ).attr('disabled', 'disabled').button('disable');
            });
            $('#btnDel').click(function() {
                var num = $('.clonedInput').length;
                $('#input' + num).remove();

                if (num == 2){
                    $('#btnDel' ).attr('disabled', 'disabled').button('disable');
                }
            });
        });
    </script>
    </body>
</html>
