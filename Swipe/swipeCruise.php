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
     "td_user_data"=>"$_POST[fname]",
     "td_email"=>"$_POST[email]",
     "td_phone"=>"$_POST[mobile]",
     "td_item" => "Cruise Ship Hire",
     "td_amount" => $finalCalc,
     "td_description" => "Brief description of my product",
     );

    $result = post_to_url("https://api.swipehq.com/createTransactionIdentifier.php", $postData);

    $test = json_decode($result,true);
    $test = array_values($test);
    //print_r($test[2]['identifier']);

            ?>

        <div id="SwipeButton" class="col-md-12 row text-center" style="padding: 52px;">
        <a style="text-align:center;" data-role="button" data-theme="b" href='https://payment.swipehq.com/?identifier_id=<?php print_r($test[2]['identifier']); ?>'>
        Make Payment
        </a>
                </div>
