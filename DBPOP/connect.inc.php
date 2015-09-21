<?php

//login to server
$host="localhost"; $userMS="root"; $passwordMS="jamaica1992";

//connect to...
$connection=mysql_connect($host,$userMS,$passwordMS)
    or  die("Couldn't connect:" .mysql_error());

?>
