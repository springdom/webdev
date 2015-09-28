<?php

include 'connect.inc.php';
$database = "ibike";
$db = mysql_select_db($database, $connection) or die("Couldn't select database");

        //Start listbox[gender]
 $selectStatement = "SELECT * FROM bikes";
    $result = mysql_query($selectStatement) or  die("Couldn't connect:" .mysql_error());

$array = mysql_fetch_row($result);     
echo json_encode($array);
//    echo("<table>");
//
//    //start while loop(prints data to screen)
//    while($row = mysql_fetch_assoc($result))
//    {
//
//        //foreach start
//        foreach($row as $index=>$value)
//        {
//        //if for images and values to put in table format
//        if($index=='Bike_Img')
//        {
//            echo("
//            <td>
//                <img src=../images/$value width=80px/>
//            </td>");
//        }
//        elseif($index=='Bike_ID')
//        {
//        echo("<td>$value</td>");
//        $id=$value;
//        }
//        else
//        {
//        echo("<td>$value</td>");
//        }
//        //end
//        }//end for loop
//        echo("</tr>");
//    }
//    //end while loop
//    echo("</table>");//end table

?>
