<?php
    $data = array(
        "client" => array("clientName" => "Test Testing", "address" => "123 Test St. Qc, 123123, CA", "email" => "test@test.com", "phone" => "15149999999")
    );
    
    $data_string = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/ResumeBuilder/api/client/");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    //curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type:application/json',
            'Content-Length: ' . strlen($data_string),
            'Accept:application/json',
        )
    );
    
    $result = curl_exec($ch);
    curl_close($ch);
?>