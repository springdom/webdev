<?php
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
