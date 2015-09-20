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
         <link rel="stylesheet" type="text/css" href="css/hireForm.css" />
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
<!--<link rel="stylesheet" href="http://192.168.1.73/webstuff/iBike/jquery/jquery.mobile-1.3.2.min.css" />
<script src="http://192.168.1.73/webstuff/iBike/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="http://192.168.1.73/webstuff/iBike/jquery/jquery.mobile-1.3.2.min.js" type="text/javascript"></script>-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script src="http://localhost/webstuff/iBike/js/index.js"></script><script src="index.js"></script>

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
            <a href="Bike_Select.php"  rel="external">Bike Selection</a>
        </li>
        <li>
            <a href="Hire_Form.php" data-theme="b"  rel="external">Form To Complete</a>
        </li>
        <li>
            <a href="Hire_Confirm.php"  rel="external" class="ui-disabled">Confirm and Pay</a>
        </li>
        </ul>
        </div>
<!-- /navbar -->
</div>
<!-- /header -->
    <a style="text-align:center; text-transform:uppercase;" href="Hcontact.html" data-role="button" data-icon="arrow-r" data-iconpos="right" data-theme="b" >Contact Us Now!</a>
<!--divMaincomtent start-->
<div data-role="content" id="mainContent">
<?php
error_reporting(0);
date_default_timezone_set('Australia/Melbourne');
$today = date('m/d/Y');
$m=date('m',strtotime($today));

$_SESSION['firstName']="";
$_SESSION['email']="";
$_SESSION['cellNumber']="";
$_SESSION['height']="";
$_SESSION['date']="";
$_SESSION['time']="";
$_SESSION['extras']="";
$_SESSION['gel']=0;
$_SESSION['rack']=0;
$_SESSION['bags']=0;
$_SESSION['bikeAmount']=0;
$_SESSION['daysAmount']=0;
$_SESSION['delAddress']="";
$_SESSION['final']=0;

if(isset($_POST['submit']) || $_SESSION['total']!=0)
    {
    $price=$_POST['price'];
    $_SESSION['total']=0;
//SESSION in value
//start div bike
echo("<div id='bike_descr' style='text-align:right;'>");
//$price switch start
    switch($price)
    {
    //Scott Speedster
        case "MTB.jpg":
        case $_SESSION['total']=35:
        $_SESSION['total']=35;
        break;
    //Avanti Giro
        case "Road.jpg":
        case $_SESSION['total']=35:
        $_SESSION['total']=70;
        break;
    //Giant Faith
        case "Downhill.jpg":
        case $_SESSION['total']=35:
        $_SESSION['total']=140;
        break;
    }
//$price switch end
echo("</div>");
//end div
echo"<h1>Step 2: Please Complete Form</h1>";
    $self = htmlentities($_SERVER['PHP_SELF']);
//form start
echo("<p style='text-align:right;'>* = required fields</p>");
    echo("
    <form action = 'Hire_Confirm.php' method='POST' name='form1'>
    <fieldset>");
//Full Name
    echo"<label for='text-basic'>Full Name:*</label>
             <input name='fName' id='text-basic' value='' type='text' placeholder='Full name' required>";
    echo"<p style='text-align:center;'>Please enter either Email address or Mobile Number</p>";
    echo"<label for='text-basic2'>Email:</label>
             <input name='email' id='text-basic2' value='' type='text' placeholder='Email'>";
//Mobile Number
    echo"<label for='tel'>Mobile:</label>
             <input type='tel' name='mobile' id='tel' placeholder='Mobile' value='' type='tel' onkeypress='return isNumberKey(event)' maxlength='10'>";
    echo"<br>";
//No. of Bikes
    echo"<label for='number-pattern'>No. of bikes(maximum of 6 bikes):*</label>";
echo"<select name='Nbikes' id='number-pattern' required>
     <option value='1'>1 Bike</option>
     <option value='2'>2 Bikes</option>
     <option value='3'>3 Bikes</option>
     <option value='4'>4 Bikes</option>
     <option value='5'>5 Bikes</option>
     <option value='6'>6 Bikes</option>
</select>";
//No. of days
echo"<label for='number-pattern2'>No. of days (maximum of 5 days):*</label>";
if($price=="Downhill.jpg")
{
echo"<select name='Ndays' id='number-pattern2' required>
     <option value='0.5'>half day</option>
     <option value='1'>1 Day</option>
     <option value='2'>2 Days</option>
     <option value='3'>3 Days</option>
     <option value='4'>4 Days</option>
     <option value='5'>5 Days</option>
</select>";
}
else
{
//No. of Days
echo"<select name='Ndays' id='number-pattern2' required>
     <option value='1'>1 Day</option>
     <option value='2'>2 Days</option>
     <option value='3'>3 Days</option>
     <option value='4'>4 Days</option>
     <option value='5'>5 Days</option>
</select>";
}
        echo"<p style='text-align:center;'>if you wish to request more bikes or days please contact us now
        <a href='Contact_Now.html' data-role='button' data-icon='info' data-iconpos='notext' data-theme='e' data-inline='true'>Info</a></p>
        ";
//height start
    echo"
    <script>
    $(document).ready(function() {
    $('#btnAdd').click(function() {
    $('#btnDel').removeAttr('disabled').button('enable');
    var num     = $('.clonedInput').length;

    var newNum  = new Number(num + 1);
    var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);

    newElem.children(':first').attr('name','id' + newNum).attr('height', 'height' + newNum);
    $('#input' + num).after(newElem);

    if (newNum == 6)
     $('#btnAdd' ).attr('disabled', 'disabled').button('disable');
    });
    $('#btnDel').click(function() {
    var num = $('.clonedInput').length;
    $('#input' + num).remove();

   $('#btnAdd').removeAttr('disabled').button('enable');

    if (num-1 == 1){
         $('#btnDel' ).attr('disabled', 'disabled').button('disable');}
    });
    });
</script>

    <label for='height1'>Please enter your Height(cm)</label>
    <div id='input1' style='margin-bottom:4px;' class='clonedInput'>
       Height:<input name='height[]' id='height1' value=''type='number' maxlength='3' onkeypress='return isNumberKey(event)' max='250' required>
    </div>

    <div>
        <input type='button' id='btnAdd' data-icon='plus' data-theme='b' value='add additional riders height' />
        <input type='button' id='btnDel' disabled data-icon='minus'  data-theme='b' value='remove additonal height' />
    </div>";
//height end
//Extra Accesories
//NOTE:Removed fix equation
    echo"<br>";
//extras amount start
echo"<label>Extras:</label><br>
<fieldset class='ui-grid-b'>
    <div class='ui-block-a'>
    <label for='gel'>Gel Seats</label>
    <select name='gel' id='gel'>
    <option value='0'>None</option>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    </select>
    </div>
    <div class='ui-block-b'>
    <label for='rack'>Bike Racks</label>
    <select name='rack' id='rack'>
    <option value='0'>None</option>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    </select>
    </div>
    <div class='ui-block-b'>
    <label for='bags'>Pannier Bike Bags</label>
    <select name='bags' id='bags'>
    <option value='0'>None</option>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    </select>
    </div>
</fieldset>";
//extras amount end
//Delivery date and time
//Date start
$day=date("d");
$month=date("m");
$year=date("y");
echo"<label>Please enter a Delivery Date</label><br>";
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
<option value='2014'<?php if($month=="2014") { echo 'selected="selected"'; } else { echo ''; } ?>>2014</option>
<option value='2015'<?php if($month=="2015") { echo 'selected="selected"'; } else { echo ''; } ?>>2015</option>
<option value='2016'<?php if($month=="2016") { echo 'selected="selected"'; } else { echo ''; } ?>>2016</option>
</select>
    </div>
</fieldset>
<?php
echo"<label>Please enter Delivery time</label><br>";?>
<fieldset class='ui-grid-b'>
    <div class='ui-block-a'>
    <label for='hours'>Hours</label>
    <select name='hours' id='hours'>
    <option value='01'>1</option>
    <option value='02'>2</option>
    <option value='03'>3</option>
    <option value='04'>4</option>
    <option value='05'>5</option>
    <option value='06'>6</option>
    <option value='07'>7</option>
    <option value='08'>8</option>
    <option value='09'>9</option>
    <option value='10'>10</option>
    <option value='11'>11</option>
    <option value='12' selected="selected">12</option>
    </select>
    </div>
    <div class='ui-block-b'>
    <label for='mins'>Minutes</label>
    <select name='mins' id='mins'>
    <option value='00'>00</option>
    <option value='01'>01</option>
    <option value='02'>02</option>
    <option value='03'>03</option>
    <option value='04'>04</option>
    <option value='05'>05</option>
    <option value='06'>06</option>
    <option value='07'>07</option>
    <option value='08'>08</option>
    <option value='09'>09</option>
    <option value='10'>10</option>
    <option value='11'>11</option>
    <option value='12'>12</option>
    <option value='13'>13</option>
    <option value='14'>14</option>
    <option value='15'>15</option>
    <option value='16'>16</option>
    <option value='17'>17</option>
    <option value='18'>18</option>
    <option value='19'>19</option>
    <option value='20'>20</option>
    <option value='21'>21</option>
    <option value='22'>22</option>
    <option value='23'>23</option>
    <option value='24'>24</option>
    <option value='25'>25</option>
    <option value='26'>26</option>
    <option value='27'>27</option>
    <option value='28'>28</option>
    <option value='29'>29</option>
    <option value='30'>30</option>
    <option value='31'>31</option>
    <option value='32'>32</option>
    <option value='33'>33</option>
    <option value='34'>34</option>
    <option value='35'>35</option>
    <option value='36'>36</option>
    <option value='37'>37</option>
    <option value='38'>38</option>
    <option value='39'>39</option>
    <option value='40'>40</option>
    <option value='41'>41</option>
    <option value='42'>42</option>
    <option value='43'>43</option>
    <option value='44'>44</option>
    <option value='45'>45</option>
    <option value='46'>46</option>
    <option value='47'>47</option>
    <option value='48'>48</option>
    <option value='49'>49</option>
    <option value='50'>50</option>
    <option value='51'>51</option>
    <option value='52'>52</option>
    <option value='53'>53</option>
    <option value='54'>54</option>
    <option value='55'>55</option>
    <option value='56'>56</option>
    <option value='57'>57</option>
    <option value='58'>58</option>
    <option value='59'>59</option>
    </select>
    </div>
    <div class='ui-block-c'>
    <label for='ampm'>am/pm</label>
<select name='ampm' id='ampm'>
<option value='am'>am</option>
<option value='pm'selected="selected">pm</option>
</select>
    </div>
</fieldset>
    <?php
//address
    echo("
    <fieldset>");
        echo"<span>Delivery Address*</span><input type='text' name='address' placeholder='Address' required/>";
        echo"<span>City</span><input type='text' name='city' value='Dunedin' disabled='disabled' />";
//Terms and conditions
    echo"&nbsp;";
         echo"<p style='text-align:center;'>By clicking Next I accept iBike Hire Terms and Conditions<br>
         <a href='tandc.html' target='_blank' style='color:red; font-size:12px;'>View Terms and Conditions here</a></p>";
    echo"&nbsp;";
    echo"<input type='submit' name='submit' value ='Next' class='butn' data-theme='b' onclick='return check();'>";
    echo("</fieldset>
    </form>");
//form end on sbmut
    }
    else
    {
    echo"<p class='pfont'>error! Please Select a bike</p>";
    }
?>
<a style="text-align:center;" href="Bike_Select.php" data-role="button" data-theme="b" >Go Back</a>
    </div>
<div data-role="footer" class="ui-bar" id="footer">
<a href="index.html" data-icon="home" data-theme="d" class="ui-btn-left" rel="external">Return Home</a>
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
