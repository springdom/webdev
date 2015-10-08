<?php

include 'connect.inc.php';
$database = "ibike";
$db = mysql_select_db($database, $connection) or die("Couldn't select database");

        //Start listbox[gender]
 $selectStatement = "SELECT * FROM bikes";
    $result = mysql_query($selectStatement) or  die("Couldn't connect:" .mysql_error());


//$array = mysql_fetch_row($result);

 $data = array();
 while($row = mysql_fetch_array($result)){
  $row_data = array(
   'Name' => $row['Bike_Name'],
   'Descr' => $row['Bike_Descr'],
    'Image' => $row['Bike_Img'],
    'Price' => $row['Bike_Price']
   );
  array_push($data, $row_data);
 }

echo json_encode($data);
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
